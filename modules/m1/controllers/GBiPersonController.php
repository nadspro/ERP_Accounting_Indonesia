<?php

class GBiPersonController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/*
	 public function filters()
	 {
	return array(
			'accessControl', // perform access control for CRUD operations
			'ajaxOnly + PersonAutoComplete',
			array(
					'COutputCache +index',
					// will expire in a year
					'duration'=>24*3600*365,
					'dependency'=>array(
							'class'=>'CChainedCacheDependency',
							'dependencies'=>array(
									new CGlobalStateCacheDependency('gperson'),
									new CDbCacheDependency('SELECT id FROM g_person
											ORDER BY id DESC LIMIT 1'),
							),
					),
			),
	);
	}
	*/

	/**
	 * @return array action filters
	 */

	public function filters()
	{
		return array(
				'rights',
		);
	}

	private function sanitize($string = '', $is_filename = FALSE)
	{
		 // Replace all weird characters with dashes
		 $string = preg_replace('/[^\w\-'. ($is_filename ? '~_\.' : ''). ']+/u', '-', $string);
		
		 // Only allow one dash separator at a time (and make string lowercase)
		 return mb_strtolower(preg_replace('/--+/u', '-', $string), 'UTF-8');
	}	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model= new fBusinessIntellegence;
				
		if(isset($_POST['field']))
		{
			$model->field=$_POST['field'];
			$model->group=$_POST['group'];
			$model->fieldfilter=$_POST['fieldfilter'];
			$model->expression=$_POST['expression'];
			$model->value=$_POST['value'];
			$model->limit=$_POST['fBusinessIntellegence']['limit'];
			
			//SELECT
			foreach ($_POST['field'] as $key=>$mgroup) {
				if ($_POST['group'][$key] == null ||  $_POST['group'][$key] == 'GROUP BY') {
					$fieldarray[]=$_POST['field'][$key];
				} else 
					$matharray[]=$_POST['group'][$key]."(".$_POST['field'][$key].") as ".$_POST['field'][$key];
			}
			
			$field=implode(",",$fieldarray);
			//$group=" GROUP BY ".implode(",",$fieldarray);
			$group = "";
			//$filter= "";
			
			if (isset($matharray)) {
				$math=implode(",",$matharray);
				$field=$math.",".$field;
				$sql='SELECT min(id) as id,'.$field.' FROM g_bi_person ';
			} else
				$sql='SELECT id, '.$field.' FROM g_bi_person ';
			
			
			//FILTER
			if ($_POST['value'][0] != null) {
				foreach ($_POST['value'] as $key=>$mfilter) 
					if ($_POST['expression'][$key] != null || $_POST['value'][$key] != null) {
						$filterserial[]=$_POST['fieldfilter'][$key].' '.$_POST['expression'][$key].' "'.$_POST['value'][$key].'" ';
					}

				$filter=implode(" AND ",$filterserial);
				
			}

			if (!$_POST['fBusinessIntellegence']['plusResign']) 
				if (isset($filter)) {
					$filter=$filter.' AND employee_status NOT IN ("Resign","Termination","End Of Contract","Unpaid Leave","Black List") ';
				} else 
					$filter=' employee_status NOT IN ("Resign","Termination","End Of Contract","Unpaid Leave","Black List") ';
			
			//Filter By Company
			if (isset($filter)) {
				$filter=$filter.' AND company_id IN ('.implode(",",sUser::model()->getGroupArray()).')';
			} else
				$filter='company_id IN ('.implode(",",sUser::model()->getGroupArray()).')';
			
						
			if (isset($filter)) {
				$sql=$sql.' WHERE '.$filter.$group.' LIMIT '.$_POST['fBusinessIntellegence']['limit'];
			} else
				$sql=$sql.' '.$group.' LIMIT '.$_POST['fBusinessIntellegence']['limit'];
			
			try {
				$rawData=Yii::app()->db->createCommand($sql)->queryAll();
			}  
			catch (Exception $e)  
			{  
				throw new CHttpException(404,'Error Code: 1064. You have an error in your SQL syntax. Press Backspace to return...');
			}  				
			
			$dataProvider=new CArrayDataProvider($rawData, array(
				'id'=>'bi_person',
				'pagination'=>false,
			));				
			
			//'columns'=>array(
			//	'start_date',
			//	array(
			//			'header'=>'Status',
			//			'value'=>'isset($data->status->name) ? $data->status->name : ""',
			//	),
						
			$labels=gBiPerson::model()->attributeLabels();
			foreach ($model->field as $key=>$mgroup) {
					$fieldres['header']=$labels[$mgroup];

					if ($labels[$mgroup] == "Employee Name") {
						$fieldres['type']='raw';
						$fieldres['value']='CHtml::link($data["'.$mgroup.'"],Yii::app()->createUrl("/m1/gPerson/view",array("id"=>$data["id"])),array("target"=>"_blank"))';
					} else
						$fieldres['value']='$data["'.$mgroup.'"]';
						
					$fieldresult[]=$fieldres;
			}
			
			if ($_POST['fBusinessIntellegence']['export']) {
				$production = 'export';
			} else {
				$production = 'grid';
			}
		
			$this->render('index',array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
				'field'=>$fieldresult,
				'production'=>$production,
				'sql'=>$sql,

			));
			
			Yii::app()->end();
		}
		
		$this->render('index',array(
			'model'=>$model,
		));
	}

}
