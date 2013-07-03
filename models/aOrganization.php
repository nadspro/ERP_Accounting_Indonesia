<?php

class aOrganization extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'a_organization';
	}

	public function rules()
	{
		return array(
			array('name, branch_code, custom1, custom2, custom3', 'required'),
			array('kabupaten_id, propinsi_id, created_date, created_by, updated_date, updated_by, parent_id, status_id', 'numerical', 'integerOnly'=>true),
			array('branch_code, name, pos_code, phone_code_area, telephone, fax, email, website', 'length', 'max'=>50),					
			array('address', 'length', 'max'=>300),
			array('branch_code_number', 'length', 'max'=>10),
			array('photo_path,custom1, custom2, custom3', 'length', 'max'=>100),
			array('id, branch_code, name, address, pos_code, phone_code_area, telephone, fax, email, website, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'getparent' => array(self::BELONGS_TO, 'aOrganization', 'parent_id'),
			'childs' => array(self::HAS_MANY, 'aOrganization', 'parent_id', 'order' => 'name ASC'),
			'entityAccount' => array(self::HAS_MANY, 'aAccountEntity', 'entity_id', 'order' => 'id ASC'),
			'status' => array(self::BELONGS_TO, 'sParameter', array('status_id'=>'code'),'condition'=>'type = "cOrganizationStatus"'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent ID',
			'branch_code' => 'Branch Code',
			'branch_code_number' => 'Branch Code Number',
			'name' => 'Name',
			'address' => 'address',
			'kabupaten_id' => 'Kab/Kodya',
			'propinsi_id' => 'Propinsi',
			'pos_code' => 'Kode Pos',
			'phone_code_area' => 'Kode Area',
			'telephone' => 'telephone',
			'fax' => 'Fax',
			'email' => 'Email',
			'website' => 'Website',
			'photo_path' => 'Photo Path',
			'status_id' => 'Status',
			'custom1' => 'Company Code',
			'custom2' => 'Ownership',
			'custom3' => 'Area',
			'custom4' => 'Custom4',
			'custom5' => 'Custom5',
			'created_date' => 'Created Date',
			'created_by' => 'Created',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public function searchChild($id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20
			)
		));
	}

	public function getTree() {
		$subitems = array();

		if($this->childs) foreach($this->childs as $child) {
			$subitems[] = $child->getTree();
		}

		$returnarray = array(
				'text' => CHtml::link($this->name,Yii::app()->createUrl('/aOrganization/view',array('id'=>$this->id))));

		if($subitems != array())
			$returnarray = array_merge($returnarray, array('children' => $subitems));
		return $returnarray;
	}

	public function getTreeUser() {
		$subitems = array();

		if (($this->childs) && ($this->parent_id == 0 || $this->getparent->parent_id == 0))
			foreach($this->childs as $child) {
				$subitems[] = $child->getTreeUser();
		}

		$returnarray = array(
				'text' => CHtml::link($this->name,Yii::app()->createUrl('/sUser/index',array('pid'=>$this->id))));

		if($subitems != array())
			$returnarray = array_merge($returnarray, array('children' => $subitems));
		return $returnarray;
	}

	public function getTopCreated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->name, 'label' => $model->name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopUpdated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->name, 'label' => $model->name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopRelated($id) {

		$_related = self::model()->findByPk((int)$id)->name;
		$_exp=explode(" ",$_related);


		$criteria=new CDbCriteria;

		if (isset($_exp[0]))
			$criteria->compare('name',$_exp[0],true,'OR');

		if (isset($_exp[1]))
			$criteria->compare('name',$_exp[1],true,'OR');
			
		$criteria->limit=10;
		$criteria->order='updated_date DESC';

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->name, 'label' => $model->name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getParentFamily($id) {

		$model=self::model()->findByPk($id);
		
		$criteria=new CDbCriteria;

		if (isset($model->getparent->parent_id) && $model->getparent->parent_id !=0) {
			$criteria->compare('parent_id',$model->getparent->parent_id);
		} else
			$criteria->compare('id',0); //null
			
		$criteria->limit=10;
		$criteria->order='sort';

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->name, 'label' => $model->name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function items()
	{

		$models=self::model()->findAll();

		foreach($models as $model) {
			$_items[$model->id]=$model->name;
		}

		return $_items;
	}

	/////////////////////////////////////////////
	public function getRootList() {

		$models=self::model()->findAll(array('condition'=>'parent_id = 0'));


		$_items=array();

		foreach($models as $model)
			$_items[$model->id]=$model->name;

		return $_items;
	}

	/////////////////////////////////////////////
	public function getListProject() {

		$models=self::model()->findAll('parent_id ='.sUser::model()->getGroupRoot());


		$_items=array();

		$_items[sUser::model()->getGroupRoot()]="(ALL)";

		foreach($models as $model)
			foreach($model->childs as $mod)
			$_items[$mod->id]=$mod->name;

		return $_items;
	}

	public function getTopLevel() {
		if ($this->parent_id == 0) {
			$_level=$this->name;
		} elseif ($this->getparent->parent_id == 0) {
			$_level=$this->getparent->name;
		} elseif ($this->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->name;
		} elseif ($this->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->name;
		} elseif ($this->getparent->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->getparent->name;
		} elseif ($this->getparent->getparent->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->getparent->getparent->name;
		}

		return $_level;
	}

	public function getTopLevelId() {
		if ($this->parent_id == 0) {
			$_level=$this->id;
		} elseif ($this->getparent->parent_id == 0) {
			$_level=$this->getparent->id;
		} elseif ($this->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->id;
		} elseif ($this->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->id;
		} elseif ($this->getparent->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->getparent->id;
		} elseif ($this->getparent->getparent->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->getparent->getparent->id;
		}

		return $_level;
	}

	public function getTopStatus($show=false) {
		if ($show) {
			$_status=" Active";
		} else
			$_status="";

		if ($this->status_id == 2) {
			$_status=' [Archived]';
		} elseif (isset($this->getparent->status_id) &&
			$this->getparent->status_id == 2) {
			$_status=' [*Archived*]';
		} elseif (isset($this->getparent->getparent->status_id) &&
			$this->getparent->getparent->status_id == 2) {
			$_status=' [*Archived*]';
		} elseif (isset($this->getparent->getparent->getparent->status_id) &&
			$this->getparent->getparent->getparent->status_id == 2) {
			$_status=' [*Archived*]';
		} elseif (isset($this->getparent->getparent->getparent->getparent->status_id) &&
			$this->getparent->getparent->getparent->getparent->status_id == 2) {
			$_status=' [*Archived*]';
		} elseif (isset($this->getparent->getparent->getparent->getparent->getparent->status_id) &&
			$this->getparent->getparent->getparent->getparent->getparent->status_id == 2) {
			$_status=' [*Archived*]';
		}

		return $_status;
	}

	/////////////////////////////////////////////
	public function getListed($id) {

		$models=self::model()->findAll(array('condition'=>'parent_id = 0'));
		$mod=self::model()->findByPk((int)$id);


		$_items=array();
		$_items1=array();

		foreach($models as $model)
			$_items[$model->name]=array('label' => $model->name, 'icon'=>'list-alt', 'url' => array('index', 'id'=>$model->id));

		$_items1[$model->name]= array('label' =>'Project: '.$mod->name, 'icon'=>'list-alt', 'url' => array('index', 'id'=>$model->id),'items'=>$_items);

		return $_items1;
	}

	public function getData($cnd = " = 0") {
		$data = array();
		foreach(aOrganization::model()->findAll('parent_id '.$cnd) as $model) {
			$row['text'] = $model->name;
			$row['id'] = $model->id;
			$row['children'] = aOrganization::model()->getData(' = '.$model->id);
			$data[] = $row;
		}
		return $data;
	}

	public function getListPersonalia() {
		$subitems = array();

		$model=$this->find(array(
				'condition'=>'id = :id',
				'params'=>array(':id'=>$this->id),
		));
		if($this->childs) foreach($this->childs as $child)
			$subitems[] = $child->getListPersonalia();

		$returnarray = array('label' => $this->name, 'icon'=>'list-alt', 'url' => Yii::app()->createUrl("/cPersonalia/index",array("id"=>$this->id)));

		if($subitems != array())
			$returnarray = array_merge($returnarray, array('items' => $subitems));

		return $returnarray;

	}

	public function getListAbsence() {
		$subitems = array();

		$model=$this->find(array(
				'condition'=>'id = :id',
				'params'=>array(':id'=>$this->id),
		));
		if($this->childs) foreach($this->childs as $child)
			$subitems[] = $child->getListAbsence();

		$returnarray = array('label' => $this->name, 'icon'=>'list-alt', 'url' => Yii::app()->createUrl("/cAbsence/index",array("id"=>$this->id)));

		if($subitems != array())
			$returnarray = array_merge($returnarray, array('items' => $subitems));

		return $returnarray;

	}

	public static function companyDropDown()
	{
		$_items=array();

		//Dev
		$criteria=new CDbCriteria;
		$criteria->order='sort';
		$criteria->compare('parent_id',669);

		if (Yii::app()->user->name != "admin") {
			$criteria2 = new CDbCriteria;
			$criteria2->condition='t.id IN ('.implode(",",sUser::model()->getGroupArray()).')' ;
			$criteria->mergeWith($criteria2);
		}

		$models=self::model()->findAll($criteria);
		foreach($models as $model)
			$_items[$model->getparent->sort ." ". $model->getparent->name][$model->id]=$model->name;

		//POM
		$criteria=new CDbCriteria;
		$criteria->order='sort';
		$criteria->compare('parent_id',670);

		if (Yii::app()->user->name != "admin") {
			$criteria3 = new CDbCriteria;
			$criteria3->condition='t.id IN ('.implode(",",sUser::model()->getGroupArray()).')' ;
			$criteria->mergeWith($criteria3);
		}

		$models=self::model()->findAll($criteria);
		foreach($models as $model)
			$_items[$model->getparent->sort ." ". $model->getparent->name][$model->id]=$model->name;

		//HOLDING
		$criteria=new CDbCriteria;
		$criteria->order='sort';
		$criteria->compare('parent_id',971);

		if (Yii::app()->user->name != "admin") {
			$criteria4 = new CDbCriteria;
			$criteria4->condition='t.id IN ('.implode(",",sUser::model()->getGroupArray()).')' ;
			$criteria->mergeWith($criteria4);
		}

		$models=self::model()->findAll($criteria);
		foreach($models as $model)
			$_items[$model->getparent->sort ." ". $model->getparent->name][$model->id]=$model->name;

		//OLD_PROJECT
		$criteria=new CDbCriteria;
		$criteria->order='sort';
		$criteria->compare('parent_id',1690);

		if (Yii::app()->user->name != "admin") {
			$criteria5 = new CDbCriteria;
			$criteria5->condition='t.id IN ('.implode(",",sUser::model()->getGroupArray()).')' ;
			$criteria->mergeWith($criteria5);
		}

		$models=self::model()->findAll($criteria);
		foreach($models as $model)
			$_items[$model->getparent->sort ." ". $model->getparent->name][$model->id]=$model->name;

			return $_items;
	}

	public static function deptByCompany($id=0)
	{
		$_items=array();

		$criteria=new CDbCriteria;
		$criteria->order='sort';
		$criteria->compare('parent_id',1099);
		$models=self::model()->findAll($criteria);
		foreach($models as $model) {
			foreach($model->childs as $mod)
				foreach($mod->childs as $m)
				$_items[$m->getparent->getparent->name ." - ". $m->getparent->name][$m->id]=$m->name;
		}

		return $_items;
	}

	public static function compDeptGroup()
	{
		$_items=array();
		$default=sUser::model()->getGroup();
		$org=aOrganization::model()->find('parent_id = '.$default);
		$dept=$org->childs[0]->id;

		$criteria=new CDbCriteria;
		$criteria->order='id';
		$criteria->compare('parent_id',$dept);
		$models=self::model()->findAll($criteria);
		foreach($models as $model) 
				$_items[]=$model->name;
		

		return $_items;
	}

	public static function compByParent($id)
	{
		$_items=array();

		$criteria=new CDbCriteria;
		$criteria->order='id';
		$criteria->compare('parent_id',$id);
		$models=self::model()->findAll($criteria);
		foreach($models as $model) 
				$_items[]=$model->name;
		

		return $_items;
	}

	public static function compDeptGroupRedirect()
	{
		$_items=array();

		$criteria=new CDbCriteria;
		$criteria->order='t.id';
		$criteria->with=array('getparent');
		//$criteria->compare('getparent.parent_id',1153);
		$criteria->compare('getparent.parent_id',self::model()->findByPk(sUser::model()->getGroup())->childs[0]->id);
		$models=self::model()->findAll($criteria);
		foreach($models as $model) 
				$_items[$model->id]=$model->name;
		

		return $_items;
	}

	public static function compDeptPersonFilter()
	{
		$_itemsmain=array();
		$_items=array();
		$_itemsurl=array();

		$criteria=new CDbCriteria;
		$criteria->order='t.id';
		$criteria->with=array('getparent');
		$criteria->compare('getparent.parent_id',self::model()->findByPk(sUser::model()->getGroup())->childs[0]->id);
	
		$models=self::model()->findAll($criteria);
		
		$_items['label']='Home';
		$_items['icon']='list';
		$_items['url']=Yii::app()->createUrl('/m1/gPerson');
		$_itemsmain[]=$_items;
		
		foreach($models as $model) {
				$_items['label']= (strlen($model->name) >=18) ? substr($model->name,0,18).".." : $model->name;
				$_items['icon']='list';
				$_items['url']=Yii::app()->createUrl('/m1/gPerson/index',array('pid'=>$model->id));
				$_itemsmain[]=$_items;
		}
		
		return $_itemsmain;
	}

	public static function compDeptPayrollFilter()
	{
		$_itemsmain=array();
		$_items=array();
		$_itemsurl=array();

		$criteria=new CDbCriteria;
		$criteria->order='t.id';
		$criteria->with=array('getparent');
		$criteria->compare('getparent.parent_id',self::model()->findByPk(sUser::model()->getGroup())->childs[0]->id);
	
		$models=self::model()->findAll($criteria);
		
		$_items['label']='Home';
		$_items['icon']='list';
		$_items['url']=Yii::app()->createUrl('/m1/gPerson');
		$_itemsmain[]=$_items;
		
		foreach($models as $model) {
				$_items['label']= (strlen($model->name) >=18) ? substr($model->name,0,18).".." : $model->name;
				$_items['icon']='list';
				$_items['url']=Yii::app()->createUrl('/m1/kPayroll/index',array('pid'=>$model->id));
				$_itemsmain[]=$_items;
		}
		
		return $_itemsmain;
	}

	public function getPhotoExist() {
		if ($this->photo_path != null) {
			if (is_file(Yii::app()->basePath . "/../shareimages/company/" .$this->photo_path))
				return true;
			else
				return false;
		}
		return false;

	}

	public function getPhotoExistThumb() {
		if ($this->photo_path != null) {
			if (is_file(Yii::app()->basePath . "/../shareimages/company/thumb/" .$this->photo_path))
				return true;
			else
				return false;
		}
		return false;

	}

	public function getPhotoPath() {
		if ($this->photo_path != null && $this->PhotoExist) {
			if ($this->PhotoExistThumb) {
				$path=CHtml::image(Yii::app()->request->baseUrl . "/shareimages/company/thumb/" .$this->photo_path, CHtml::encode($this->name), array("width"=>"100%",'id'=>'photo'));
			} else
				$path=CHtml::image(Yii::app()->request->baseUrl . "/shareimages/company/" .$this->photo_path, CHtml::encode($this->name), array("width"=>"100%",'id'=>'photo'));
			
		} else {
				$path=CHtml::image(Yii::app()->request->baseUrl . "/shareimages/company/logo_ONLY.jpg", CHtml::encode($this->name), array("width"=>"100%",'id'=>'photo'));
		}
		return $path;

	}



}