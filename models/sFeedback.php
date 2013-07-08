<?php

class sFeedback extends BaseModel {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 's_feedback';
    }

    public function rules() {
        return array(
            array('long_desc', 'required'),
            array('sender_date, type_id, broadcast_code, sender_id, receiver_date, receiver_id, receiver_ref, category_id, status_id, priority_level_id', 'numerical', 'integerOnly' => true),
            array('long_desc', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            array('sender_ref', 'length', 'max' => 25),
            array('link', 'length', 'max' => 100),
            //array('long_desc', 'length', 'max'=>250),
            array('id, sender_date, sender_id, sender_ref, receiver_date, receiver_id, receiver_ref, category_id, long_desc, link, status_id, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'comment' => array(self::HAS_MANY, 'sFeedbackDetail', 'parent_id'),
            'commentCount' => array(self::STAT, 'sFeedbackDetail', 'parent_id'),
            'receiver' => array(self::BELONGS_TO, 'sUser', 'receiver_id'),
            'sender' => array(self::BELONGS_TO, 'sUser', 'sender_id'),
            'status' => array(self::BELONGS_TO, 'sParameter', array('status_id' => 'code'), 'condition' => 'type = "cRead"'),
            'category' => array(self::BELONGS_TO, 'sParameter', array('category_id' => 'code'), 'condition' => 'type = "cCategory"'),
            'priority_level' => array(self::BELONGS_TO, 'sParameter', array('priority_level_id' => 'code'), 'condition' => 'type = "cPriority"'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'broadcast_code' => 'Broadcast Code',
            'type_id' => 'Type',
            'sender_date' => 'Sender Date',
            'sender_id' => 'Sender',
            'sender_ref' => 'Sender Ref',
            'receiver_date' => 'Receiver Date',
            'receiver_id' => 'Receiver',
            'receiver_ref' => 'Receiver Ref',
            'category_id' => 'Category',
            'long_desc' => 'Message',
            'priority_level_id' => 'Priority Level',
            'priority_level.name' => 'Priority Level',
            'link' => 'Link',
            'status_id' => 'Status',
        );
    }

    public function search($id) {
        $criteria = new CDbCriteria;

        $criteria->order = 'sender_date DESC';
        $criteria->compare('status_id', $id);
        $criteria->compare('sender_id', Yii::app()->user->id);

        $criteria1 = new CDbCriteria;
        $criteria1->compare('status_id', $id);
        $criteria1->compare('receiver_id', Yii::app()->user->id);

        $criteria->mergeWith($criteria1, false);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20
            )
        ));
    }

    public function searchFilter() {
        $criteria1 = new CDbCriteria;

        $criteria1->compare('receiver_id', Yii::app()->user->id, false, 'OR');
        $criteria1->compare('sender_id', Yii::app()->user->id, false, 'OR');

        $criteria = new CDbCriteria;
        $criteria->mergeWith($criteria1);
        $criteria->compare('type_id', 2);
        $criteria->addNotInCondition('status_id', array(6));
        $criteria->order = 'sender_date DESC';

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->sender_date = time();
                $this->sender_id = yii::app()->user->id;
            }
            return true;
        }
        else
            return false;
    }

    public function getCountComment() {
        $model = sFeedbackDetail::model()->count(array(
            'condition' => 'parent_id = :id',
            'params' => array(':id' => $this->id),
        ));
        if ($model == null) {
            return 0;
        } else {
            return $model;
        }
    }

    public function getTopCreated() {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;

        $models = self::model()->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $returnarray[] = array('id' => $model->id, 'label' => $model->sender_ref . " - " . $model->sender->username, 'icon' => 'list-alt', 'url' => array('view', 'id' => $model->id));
        }

        return $returnarray;
    }

    public function getTopUpdated() {

        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('comment');
        $criteria->order = 'comment.sender_date DESC';
        $criteria->limit = 10;


        $models = self::model()->with('comment')->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $returnarray[] = array('id' => $model->id, 'label' => $model->sender_ref . " - " . $model->sender->username, 'icon' => 'list-alt', 'url' => array('view', 'id' => $model->id));
        }

        return $returnarray;
    }

    public function getTopRelated($name) {

        //$_related = self::model()->find((int)$id)->account_name;
        $_exp = explode(" ", $name);


        $criteria = new CDbCriteria;
        //$criteria->compare('name',$_related,true,'OR');

        if (isset($_exp[0]))
            $criteria->compare('name', $_exp[0], true, 'OR');

        if (isset($_exp[1]))
            $criteria->compare('name', $_exp[1], true, 'OR');

        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';

        $models = self::model()->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $returnarray[] = array('id' => $model->name, 'label' => $model->name, 'icon' => 'list-alt', 'url' => array('view', 'id' => $model->id));
        }

        return $returnarray;
    }

    public function nicetime($time) {
        $_mywaktu = new waktu;
        $_nicetime = $_mywaktu->nicetime($time);

        return $_nicetime;
    }

    public function getUnreadNotification() {
        return self::count('status_id =1 and receiver_id = ' . Yii::app()->user->id);
    }

}