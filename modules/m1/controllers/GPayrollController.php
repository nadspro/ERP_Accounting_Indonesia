<?php

class GPayrollController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2left';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelPayroll=$this->newPayroll($id);
		$modelPayrollBenefit=$this->newPayrollBenefit($id);
		$modelPayrollDeduction=$this->newPayrollDeduction($id);
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'modelPayroll'=>$modelPayroll,
			'modelPayrollBenefit'=>$modelPayrollBenefit,
			'modelPayrollDeduction'=>$modelPayrollDeduction,
		));
	}

	public function newPayroll($id)
	{
		$model=new gPayroll;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['gPayroll']))
		{
			$model->attributes=$_POST['gPayroll'];
			$model->parent_id = $id;
			if($model->save())
				$this->redirect(array('view','id'=>$id,'tab'=>'Salary History'));
		}

		return $model;
	}

	public function newPayrollBenefit($id)
	{
		$model=new gPayrollBenefit;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['gPayrollBenefit']))
		{
			$model->attributes=$_POST['gPayrollBenefit'];
			$model->parent_id = $id;
			if($model->save())
				$this->redirect(array('view','id'=>$id,'tab'=>'Benefit'));
		}

		return $model;
	}

	public function newPayrollDeduction($id)
	{
		$model=new gPayrollDeduction;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['gPayrollDeduction']))
		{
			$model->attributes=$_POST['gPayrollDeduction'];
			$model->parent_id = $id;
			if($model->save())
				$this->redirect(array('view','id'=>$id,'tab'=>'Deduction'));
		}

		return $model;
	}

	public function actionIndex()
	{
		$this->render('index',array(
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionCurrentMonth()
	{
		$criteria=new CDbCriteria;

		//if (Yii::app()->user->name != "admin") {
			$criteria2 = new CDbCriteria;
			$criteria2->condition=
			'(select s.status_id from g_person_status s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
			('.implode(",",Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY).') AND '.
			
			'(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN ('.
				implode(',',Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY).
				') ORDER BY c.start_date DESC LIMIT 1) IN ('.
				implode(",",sUser::model()->getGroupArray()).')';
			$criteria->mergeWith($criteria2);
		//}

		$criteria->order='updated_date DESC';

		$dependency = new CDbCacheDependency('SELECT MAX(id) FROM g_person');
		
		$dataProvider=new CActiveDataProvider(gPerson::model()->cache(3600, $dependency, 2), array(
				'criteria'=>$criteria,
				'pagination'=>false,
		)
		);

		$this->render('currentMonth',array(
				'dataProvider'=>$dataProvider,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return gPayroll the loaded model
	 * @throws CHttpException
	 */
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$criteria=new CDbCriteria;

		if (Yii::app()->user->name != "admin") {
			$criteria->condition='(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN ('.
				implode(',',Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY).
				') ORDER BY c.start_date DESC LIMIT 1) IN ('.
				implode(",",sUser::model()->getGroupArray()).') OR '.
				'(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN ('.
				implode(",",sUser::model()->getGroupArray()).') ORDER BY c2.start_date DESC LIMIT 1) IN ('.
				implode(",",sUser::model()->getGroupArray()).')' ;
				
		}

		$model=gPerson::model()->findByPk((int)$id,$criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	/**
	 * Performs the AJAX validation.
	 * @param gPayroll $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='g-payroll-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
