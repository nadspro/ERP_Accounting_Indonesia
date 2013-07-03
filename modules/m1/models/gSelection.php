<?php

/**
 * This is the model class for table "g_selection".
 *
 * The followings are the available columns in table 'g_selection':
 * @property integer $id
 * @property string $code
 * @property string $candidate_name
 * @property string $for_position
 * @property integer $department_id
 * @property string $address
 * @property string $address2
 * @property string $address3
 * @property string $email
 * @property string $home_phone
 * @property integer $handphone
 * @property string $birthdate
 * @property string $quick_background
 * @property string $work_experience
 * @property integer $sallary_expectation
 * @property integer $source_id
 * @property string $photo_path
 * @property string $document_date
 * @property integer $document_status_id
 * @property string $document_remark
 * @property string $join_date
 * @property string $job_title
 * @property integer $level_id
 * @property integer $status_id
 * @property string $operation_remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class gSelection extends BaseModel
{
	public $image;
	public $docs;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return gSelection the static model class
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
		return 'g_selection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('input_date, candidate_name, for_position, company_id, department_id, birthdate, quick_background, work_experience', 'required'),
			array('company_id, department_id, level_id, sallary_expectation, source_id, document_status_id, status_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>15),
			array('candidate_name, for_position, address2, address3', 'length', 'max'=>50),
			array('address', 'length', 'max'=>150),
			array('email, handphone, photo_path', 'length', 'max'=>100),
			array('home_phone, job_title', 'length', 'max'=>45),
			array('quick_background, work_experience', 'length', 'max'=>1000),
			array('document_remark, operation_remark', 'length', 'max'=>500),
			array('document_date, join_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, input_date, code, candidate_name, for_position, company_id, department_id, level_id, address, address2, address3, email, home_phone, handphone, birthdate, quick_background, work_experience, sallary_expectation, source_id, photo_path, document_date, document_status_id, document_remark, join_date, job_title, status_id, operation_remark, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'progress' => array(self::HAS_MANY, 'gSelectionProgress', 'parent_id'),
				'source' => array(self::BELONGS_TO, 'sParameter', array('source_id'=>'code'),'condition'=>'type = \'cSelectionSource\''),

				'invitation_status' => array(self::HAS_ONE, 'gSelectionProgress', 'parent_id',
				'condition'=>'workflow_id = 6 OR workflow_id = 8 OR workflow_id = 10 ','order'=>'workflow_date DESC'),
				'psychotest_status' => array(self::HAS_ONE, 'gSelectionProgress', 'parent_id',
				'condition'=>'workflow_id = 16','order'=>'workflow_date DESC'),
				'hrinterview_status' => array(self::HAS_ONE, 'gSelectionProgress', 'parent_id',
				'condition'=>'workflow_id = 11','order'=>'workflow_date DESC'),
				'userinterview_status' => array(self::HAS_ONE, 'gSelectionProgress', 'parent_id',
				'condition'=>'workflow_id = 13','order'=>'workflow_date DESC'),
				'hrfinal_result' => array(self::HAS_ONE, 'gSelectionProgress', 'parent_id',
				'condition'=>'workflow_id = 18','order'=>'workflow_date DESC'),
				'userfinal_result' => array(self::HAS_ONE, 'gSelectionProgress', 'parent_id',
				'condition'=>'workflow_id = 19','order'=>'workflow_date DESC'),

				'company' => array(self::BELONGS_TO, 'aOrganization', 'company_id'),
				'level' => array(self::BELONGS_TO, 'gParamLevel', 'level_id'),
				'department' => array(self::BELONGS_TO, 'aOrganization', 'department_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'input_date' => 'Input Date',
			'code' => 'Code',
			'candidate_name' => 'Candidate Name',
			'for_position' => 'For Position',
			'company_id' => 'Company',
			'department_id' => 'Department',
			'department.name' => 'Department',
			'address' => 'Address',
			'address2' => 'Address',
			'address3' => 'Address',
			'email' => 'Email',
			'home_phone' => 'Home Phone',
			'handphone' => 'Handphone',
			'birthdate' => 'Birthdate',
			'quick_background' => 'Quick Background',
			'work_experience' => 'Work Experience',
			'sallary_expectation' => 'Sallary Expectation',
			'source_id' => 'Source',
			'source.name' => 'Source',
			'photo_path' => 'Photo Path',
			'document_date' => 'Document Date',
			'document_status_id' => 'Document Status',
			'document_remark' => 'Document Remark',
			'join_date' => 'Join Date',
			'job_title' => 'Job Title',
			'level_id' => 'Level',
			'level.name' => 'Level',
			'status_id' => 'Status',
			'status.name' => 'Status',
			'operation_remark' => 'Operation Remark',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id,$unit=false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		switch ($id) {
		case 'newentry':
			$criteria->join='LEFT JOIN g_selection_progress gg ON t.id = gg.parent_id';
			$criteria->condition='gg.parent_id is null';
			break;
		case 'invited':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_id = 6 AND progress.workflow_result_id is NULL AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19)';
			break;
		case 'invitedresult':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_id = 6 AND progress.workflow_result_id is NOT NULL AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19)';
			break;
		case 'appointment':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_date = "'.date("Y-m-d") .'" AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19)';
			break;
		case 'appointment1':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_date = "'.date("Y-m-d",strtotime(date("Y-m-d")."+1 day")) .'" AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19)';
			break;
		case 'appointment2':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_date = "'.date("Y-m-d",strtotime(date("Y-m-d")."+2 day")) .'" AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19)';
			break;
		case 'appointment3':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_date = "'.date("Y-m-d",strtotime(date("Y-m-d")."+3 day")) .'" AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19)';
			break;
		case 'psikotestschedule':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_id = 16 AND progress.workflow_result_id is NULL AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19) ';
			break;
		case 'psikotestresult':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_id = 16 AND progress.workflow_result_id is NOT NULL AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19) ';
			break;
		case 'interviewhr':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_id = 11 AND progress.workflow_result_id is NULL AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19) ';
			break;
		case 'interviewuser':
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_id = 13 AND progress.workflow_result_id is NULL AND t.id NOT IN 
			(select tt.id from g_selection tt left join g_selection_progress pp ON tt.id = pp.parent_id Where pp.workflow_id = 19) ';
			break;
		default:
			$criteria->with=array('progress');
			$criteria->together=true;
			$criteria->condition='progress.workflow_id IN (19,21)';
		
		}
		
		$criteria->order="t.created_date DESC";
		
		if ($unit ==false)
			$criteria->compare('company_id',sUser::model()->getGroup());

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>50,
			),
		));
	}
		
	public function related($model)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('for_position',$model->for_position,true);
		$criteria->compare('company_id',$model->company_id);
		$criteria->compare('id!',$model->id);
		$criteria->order="created_date DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}

	public function relatedCompany($model)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('company_id',$model->company_id);
		$criteria->compare('id!',$model->id);
		$criteria->order="created_date DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}

	public function getPhotoExist() {
		if ($this->photo_path != null) {
			if (is_file(Yii::app()->basePath . "/../sharedocs/selection/" .$this->id."/".$this->photo_path))
				return true;
			else
				return false;
		}
		return false;

	}

	public function getPhotoPath() {
		if ($this->photo_path != null && $this->PhotoExist) {
			$path=CHtml::image(Yii::app()->request->baseUrl . "/sharedocs/selection/" .$this->id."/".$this->photo_path, CHtml::encode($this->candidate_name), array("width"=>"100%",'id'=>'photo'));
		} else {
			$path=CHtml::image(Yii::app()->request->baseUrl . "/shareimages/nophoto.jpg", CHtml::encode($this->candidate_name), array("width"=>"100%",'id'=>'photo'));
		}
		return $path;

	}

	public static function getTopCreated() {

		$criteria=new CDbCriteria;
		$criteria->limit=10;
		$criteria->order="created_date DESC";
		if (Yii::app()->user->name != "admin") {
			$criteria1 = new CDbCriteria;
			$criteria1->addInCondition('company_id',sUser::model()->getGroupArray());
			$criteria->mergeWith($criteria1);
		}
		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$_nama= (strlen($model->candidate_name) >17) ? substr($model->candidate_name,0,17)."..." : $model->candidate_name;
			$returnarray[] = array('id' => $model->id, 'label' => $_nama, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopUpdated() {

		$criteria=new CDbCriteria;
		$criteria->limit=10;
		$criteria->order="t.updated_date DESC";
		if (Yii::app()->user->name != "admin") {
			$criteria1 = new CDbCriteria;
			$criteria1->addInCondition('company_id',sUser::model()->getGroupArray());
			$criteria->mergeWith($criteria1);
		}
		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$_nama= (strlen($model->candidate_name) >17) ? substr($model->candidate_name,0,17)."..." : $model->candidate_name;
			$returnarray[] = array('id' => $model->id, 'label' => $_nama, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id,));
		}

		return $returnarray;
	}

	public function reportPsikotest($begindate, $enddate) {

		$sql="  SELECT a.name, c.parent_id,
				Sum(IF(gd.workflow_result_id=1,1,0)) AS OK, 
				Sum(IF(gd.workflow_result_id=2,1,0)) AS DP, 
				Sum(IF(gd.workflow_result_id=3,1,0)) AS NOK
				FROM a_organization a 
				LEFT JOIN g_selection g ON a.id = g.department_id
				LEFT JOIN g_selection_progress gd ON g.id = gd.parent_id
				LEFT JOIN a_organization b ON a.parent_id = b.id
				LEFT JOIN a_organization c ON b.parent_id = c.id
				WHERE g.input_date BETWEEN '".date("Y-m-d",strtotime($begindate))."' AND '".date("Y-m-d",strtotime($enddate))."'
				  AND gd.workflow_id = 16
				GROUP BY a.parent_id, a.id, a.name
				HAVING c.parent_id IN (".implode(",",sUser::model()->getGroupArray()).")
				ORDER BY g.input_date"; 
				
		$rawData=Yii::app()->db->createCommand($sql)->queryAll();

		return new CArrayDataProvider($rawData, array(
				'pagination'=>false,
		));
		
	}	
	
	public function reportInterviewHr($begindate, $enddate) {

		$sql="  SELECT a.name, c.parent_id,
				Sum(IF(gd.workflow_result_id=1,1,0)) AS OK, 
				Sum(IF(gd.workflow_result_id=2,1,0)) AS DP, 
				Sum(IF(gd.workflow_result_id=3,1,0)) AS NOK
				FROM a_organization a 
				LEFT JOIN g_selection g ON a.id = g.department_id
				LEFT JOIN g_selection_progress gd ON g.id = gd.parent_id
				LEFT JOIN a_organization b ON a.parent_id = b.id
				LEFT JOIN a_organization c ON b.parent_id = c.id
				WHERE g.input_date BETWEEN '".date("Y-m-d",strtotime($begindate))."' AND '".date("Y-m-d",strtotime($enddate))."'
				  AND gd.workflow_id = 11
				GROUP BY a.parent_id, a.id, a.name
				HAVING c.parent_id IN (".implode(",",sUser::model()->getGroupArray()).")"; 
				
		$rawData=Yii::app()->db->createCommand($sql)->queryAll();

		return new CArrayDataProvider($rawData, array(
				'pagination'=>false,
		));
		
	}	

	public function reportInterviewUser($begindate, $enddate) {

		$sql="  SELECT a.name, c.parent_id,
				Sum(IF(gd.workflow_result_id=1,1,0)) AS OK, 
				Sum(IF(gd.workflow_result_id=2,1,0)) AS DP, 
				Sum(IF(gd.workflow_result_id=3,1,0)) AS NOK
				FROM a_organization a 
				LEFT JOIN g_selection g ON a.id = g.department_id
				LEFT JOIN g_selection_progress gd ON g.id = gd.parent_id
				LEFT JOIN a_organization b ON a.parent_id = b.id
				LEFT JOIN a_organization c ON b.parent_id = c.id
				WHERE g.input_date BETWEEN '".date("Y-m-d",strtotime($begindate))."' AND '".date("Y-m-d",strtotime($enddate))."'
				  AND gd.workflow_id = 13
				GROUP BY a.parent_id, a.id, a.name
				HAVING c.parent_id IN (".implode(",",sUser::model()->getGroupArray()).")"; 
				
		$rawData=Yii::app()->db->createCommand($sql)->queryAll();

		return new CArrayDataProvider($rawData, array(
				'pagination'=>false,
		));
		
	}	
	
	public function reportSource($begindate, $enddate) {

		$sql="SELECT s.name, c.parent_id,
			SUM(IF(g.status_id=1,1,0)) AS N1, 
			SUM(IF(g.status_id=2,1,0)) AS N2, 
			SUM(IF(g.status_id=3,1,0)) AS N3, 
			SUM(IF(g.status_id=4,1,0)) AS N4
			FROM s_parameter s 
			LEFT JOIN g_selection g ON s.code = g.source_id
			LEFT JOIN a_organization a ON a.id = g.department_id
			LEFT JOIN a_organization b ON a.parent_id = b.id
			LEFT JOIN a_organization c ON b.parent_id = c.id
			WHERE g.input_date BETWEEN '".date("Y-m-d",strtotime($begindate))."' AND '".date("Y-m-d",strtotime($enddate))."'
			GROUP BY s.name,s.type
			HAVING s.type = 'cSelectionSource' AND
			c.parent_id IN (".implode(",",sUser::model()->getGroupArray()).")"; 

		$rawData=Yii::app()->db->createCommand($sql)->queryAll();

		return new CArrayDataProvider($rawData, array(
				'pagination'=>false,
		));
		
	}	

	public static function getTopRecentSelection() {

		$criteria=new CDbCriteria;
		$criteria->limit=20;
		$criteria->together=true;
		$criteria->with=array('progress');
		$criteria->order="progress.created_date DESC";

		if (Yii::app()->user->name != "admin") {
			$criteria2 = new CDbCriteria;
			$criteria2->condition='company_id IN ('.implode(",",sUser::model()->getGroupArray()).')' ;
			$criteria->mergeWith($criteria2);
		}
				

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->id, 'label' => $model->candidate_name, 'icon'=>'list-alt', 'url' => array('/m1/gSelection/view','id'=>$model->id));
		}

		return $returnarray;
	}

	
	
	public function afterSave() {
		if($this->isNewRecord) {
			Notification::create(
				2,
				'm1/gSelection/view/id/'.$this->id,
				'Selection. New Candidate created: '.$this->candidate_name .' at '. $this->company->name
			);
		}
		return true;
	}
	
}
