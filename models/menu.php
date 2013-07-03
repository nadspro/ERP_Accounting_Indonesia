<?php

class menu extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 's_module';
	}

	public function relations()
	{
		return array(
			'getparent' => array(self::BELONGS_TO, 'menu', 'parent_id'),
			'childsAuth' => array(self::HAS_MANY, 'menu', 'parent_id', 'order' => 'childsAuth.sort,childsAuth.id ASC','with'=>'user'),
			'childs' => array(self::HAS_MANY, 'menu', 'parent_id', 'order' => 'childs.sort,childs.id ASC'),
			'user' => array(self::HAS_MANY, 'sUserModule', 's_module_id', 'condition'=>'s_user_id ='.Yii::app()->user->id),
		);
	}

	public function getListed() {
		$subitems = array();

		if($this->childs) {
			if (Yii::app()->user->name == 'admin') {
				foreach($this->childs as $child)
				$subitems[] = $child->getListed();
			} else {
				foreach($this->childsAuth as $child)
				$subitems[] = $child->getListed();
			}
		}

		$_image=(isset($this->image)) ? $this->image :'th-large';

		$returnarray = array('label' => $this->title, 'icon'=>$_image, 'url' => array($this->link));

		if($subitems != array())
		$returnarray = array_merge($returnarray, array('items' => $subitems));

		return $returnarray;

	}

	public function getTree() {
		$subitems = array();

		if($this->childs) foreach($this->childs as $child) {
			$subitems[] = $child->getTree();
		}
		$returnarray = array(
				'text' => CHtml::link($this->title,Yii::app()->createUrl($this->link))." ".
		CHtml::link('.E.',Yii::app()->createUrl('smodule/update',array('id'=>$this->id))) ,
				'id' => array($this->id));
		if($subitems != array())
		$returnarray = array_merge($returnarray, array('children' => $subitems));
		return $returnarray;
	}

	public function getData($cnd=" = 0") {
		$data = array();
		foreach(menu::model()->findAll('parent_id'.$cnd) as $model) {
			$row['text'] = $model->title;
			$row['id'] = $model->id;
			$row['children'] = Menu::getData(' ='.$model->id);
			$data[] = $row;
		}
		return $data;
	}
}