<?php

/**
 * This is the model class for table "i_learning_sch".
 *
 * The followings are the available columns in table 'i_learning_sch':
 * @property integer $id
 * @property integer $parent_id
 * @property string $trainer_name
 * @property string $location
 * @property string $schedule_date
 * @property string $additional_info
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class iLearningSch extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return iLearningSch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'i_learning_sch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trainer_name, schedule_date, location', 'required'),
			array('parent_id, created_date, updated_date, status_id, cost, total_participant', 'numerical', 'integerOnly'=>true),
			array('trainer_name', 'length', 'max'=>100),
			array('actual_mandays', 'length', 'max'=>4),
			array('location', 'length', 'max'=>45),
			array('additional_info', 'length', 'max'=>500),
			array('created_by, updated_by', 'length', 'max'=>50),
			//array('schedule_date', 'date', 'format' => 'MM/dd/yyyy'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, trainer_name, location, schedule_date, additional_info, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
		);
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'getparent'=>array(self::BELONGS_TO, 'iLearning', 'parent_id'),
			'participant' => array(self::HAS_MANY, 'iLearningSchPart', 'parent_id'),
			'partCount' => array(self::STAT, 'iLearningSchPart', 'parent_id'),
			'status' => array(self::BELONGS_TO, 'sParameter', array('status_id'=>'code'),'condition'=>'type = \'cTrainingStatus\''),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'trainer_name' => 'Trainer Name',
			'location' => 'Location',
			'schedule_date' => 'Schedule Date',
			'additional_info' => 'Additional Info',
			'cost' => 'Cost',
			'status_id' => 'Status',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'partCount' => 'Total Participant',
		);
	}

	public function getPartCountFb() {
		$valCount=0;
		foreach ($this->participant as $val) 
			$valCount=$valCount+$val->feedbackCountFb;
		
		return $valCount;
	}

	public function getPartResult() {
		$valTotal=0;
		foreach ($this->participant as $val) {
			$valTotal=$valTotal+$val->feedbackCount;
		}
		
		if ($this->PartCountFb !=0) {
			$value=$valTotal/(11*$this->PartCountFb);
			$result=$this->getResultFeedback($value);
		} else			
			$result=0;
		
		return $result;
	}


	public function getResultFeedback($val) {
		$result=$val;
		if ($result ==0) {
			$_return="::Not Set::";
		} elseif ($result >0  && $result <=1.60) {
			$_return="Very Bad";
		} elseif ($result >=1.61  && $result <=2.20) {
			$_return="Bad";
		} elseif ($result >=2.21  && $result <=2.80) {
			$_return="Good";
		} else 
			$_return="Very Good";
			
		return $_return;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id,$past=false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if ($past) {
			$criteria->condition='schedule_date < now()';
		} else 
			$criteria->condition='schedule_date > now()';

		$criteria->compare('parent_id',$id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'schedule_date DESC',
			),
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchByDate($past=false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;


		if ($past) {
			$criteria->condition='schedule_date < now()';
		} else 
			$criteria->condition='schedule_date > now()';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'schedule_date DESC',
			),
			'pagination'=>array(
				'pageSize'=>25,
			)
		));
	}
		
	public static function getTopCreated() {

		$criteria=new CDbCriteria;
		$criteria->limit=10;
		$criteria->order="created_date DESC";
		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$_nama= (strlen($model->schedule_date." - ".$model->trainer_name) >28) ? substr($model->schedule_date." - ".$model->trainer_name,0,28)."..." : $model->schedule_date." - ".$model->trainer_name;
			$returnarray[] = array('id' => $model->id, 'label' => $_nama, 'icon'=>'list-alt', 'url' => array('viewDetail','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopUpdated() {

		$criteria=new CDbCriteria;
		$criteria->limit=10;
		$criteria->order="t.updated_date DESC";
		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$_nama= (strlen($model->schedule_date." - ".$model->trainer_name) >28) ? substr($model->schedule_date." - ".$model->trainer_name,0,28)."..." : $model->schedule_date." - ".$model->trainer_name;
			$returnarray[] = array('id' => $model->id, 'label' => $_nama, 'icon'=>'list-alt', 'url' => array('viewDetail','id'=>$model->id,));
		}

		return $returnarray;
	}

	public function getLearning_status() {
		if ($this->status_id != 1) {
			$_val="[".$this->status->name."] ".$this->getparent->learning_title;			
		} else
			$_val=$this->getparent->learning_title;			
		
		return $_val;		
	}
	
	public function afterSave() {
		if($this->isNewRecord) {
			Notification::create(
				1,
				'm1/iLearning/viewDetail/id/'.$this->id,
				'Learning Schedule. New Schedule created: '.$this->schedule_date .' for '.$this->getparent->learning_title
			);
		}
		return true;
	}
	
	public function compLearningClassPerMonth() {

		$_data=array();
		$dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM i_learning_sch');
		
		//if (!Yii::app()->cache->get('employeepermonth'.Yii::app()->user->id)) {
			$connection=Yii::app()->db; 
			$sql="
				select `o`.`id`, 'Class' as `state`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '".date("Y")."01') as `201301`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '".date("Y")."02') as `201302`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '".date("Y")."03') as `201303`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '".date("Y")."04') as `201304`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '".date("Y")."05') as `201305`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '".date("Y")."06') as `201306`

				FROM `a_organization` `o`
				where `id` = 1  
		
				UNION ALL
				
				select `o`.`id`, 'Participant' as `state`,
				(select count(`a`.`id`) + 
				(select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."01') from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."01') as `201301`,
				(select count(`a`.`id`)  + 
				(select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."02') from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."02') as `201302`,
				(select count(`a`.`id`)  + 
				(select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."03') from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."03') as `201303`,
				(select count(`a`.`id`)  + 
				(select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."04') from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."04') as `201304`,
				(select count(`a`.`id`)  + 
				(select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."05') from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."05') as `201305`,
				(select count(`a`.`id`)  + 
				(select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."06') from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '".date("Y")."06') as `201306`

				FROM `a_organization` `o`
				where `id` = 1  
				


			"; 
		
			$command=$connection->cache(3600, $dependency)->createCommand($sql);
			$rows=$command->queryAll();
			foreach ($rows as $row) {
				$_data=array();
				$_second=array();
				$_data[]=(int)$row['201301'];
				$_data[]=(int)$row['201302'];
				$_data[]=(int)$row['201303'];
				$_data[]=(int)$row['201304'];
				$_data[]=(int)$row['201305'];
				$_data[]=(int)$row['201306'];
				//$_data[]=(int)$row['l07'];
				//$_data[]=(int)$row['l08'];
				//$_data[]=(int)$row['l09'];
				//$_data[]=(int)$row['l10'];
				//$_data[]=(int)$row['l11'];
				//$_data[]=(int)$row['l12'];
				$_name['name']=$row['state'];
				$_second['data']=$_data;
				$_merge[]=array_merge($_name,$_second);
			}	

		//	Yii::app()->cache->set('employeepermonth'.Yii::app()->user->id,$_merge,3600,$dependency);
		//} else
		//	$_merge=Yii::app()->cache->get('employeepermonth'.Yii::app()->user->id);
		
		return $_merge;
	}
	
	public function compLearningHoursPerMonth() {

		$_data=array();
		$dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM i_learning_sch');
		
		//if (!Yii::app()->cache->get('employeepermonth'.Yii::app()->user->id)) {
			$connection=Yii::app()->db; 
			$sql="
				select `o`.`id`, 'Mandays' as `state`,
				(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					<= '".date("Y")."01') as `201301`,
				(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					<= '".date("Y")."02') as `201302`,
				(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					<= '".date("Y")."03') as `201303`,
				(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					<= '".date("Y")."04') as `201304`,
				(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					<= '".date("Y")."05') as `201305`,
				(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					<= '".date("Y")."06') as `201306`

				FROM `a_organization` `o`
				where `id` = 1  


			"; 
		
			$command=$connection->cache(3600, $dependency)->createCommand($sql);
			$rows=$command->queryAll();
			foreach ($rows as $row) {
				$_data=array();
				$_second=array();
				$_data[]=(int)$row['201301'];
				$_data[]=(int)$row['201302'];
				$_data[]=(int)$row['201303'];
				$_data[]=(int)$row['201304'];
				$_data[]=(int)$row['201305'];
				$_data[]=(int)$row['201306'];
				//$_data[]=(int)$row['l07'];
				//$_data[]=(int)$row['l08'];
				//$_data[]=(int)$row['l09'];
				//$_data[]=(int)$row['l10'];
				//$_data[]=(int)$row['l11'];
				//$_data[]=(int)$row['l12'];
				$_name['name']=$row['state'];
				$_second['data']=$_data;
				$_merge[]=array_merge($_name,$_second);
			}	

		//	Yii::app()->cache->set('employeepermonth'.Yii::app()->user->id,$_merge,3600,$dependency);
		//} else
		//	$_merge=Yii::app()->cache->get('employeepermonth'.Yii::app()->user->id);
		
		return $_merge;
	}
	
	public function getMPartCount() {
		if ($this->getparent->type_id == 3) {
			return $this->total_participant;
		} else
			return $this->partCount;
		
	
	}
}