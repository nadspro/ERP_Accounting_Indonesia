<?php

/**
 * This is the model class for table "g_param_permission".
 *
 * The followings are the available columns in table 'g_param_permission':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $sort
 * @property string $name
 * @property integer $amount
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class gParamPermission extends baseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gParamPermission the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'g_param_permission';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, amount', 'required'),
            array('parent_id, sort, amount, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, parent_id, sort, name, amount, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'sParameter', array('parent_id' => 'code'), 'condition' => 'type = \'cOffWorking\''),
            'getparent' => array(self::BELONGS_TO, 'gParamPermission', 'parent_id'),
            'childs' => array(self::HAS_MANY, 'gParamPermission', 'parent_id', 'order' => 'childs.id ASC'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'sort' => 'Sort',
            'name' => 'Name',
            'amount' => 'Amount',
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
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->order = 'sort';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50
            ),
        ));
    }

    public static function permissionDropDown() {
        $_items = array();

        $criteria = new CDbCriteria;
        $criteria->order = 'parent_id, sort';
        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[$model->category->name][$model->id] = $model->name . ' (' . $model->amount . ' days)';

        return $_items;
    }

    public static function permissionDropDownPlus() {
        $_items = array();
        $criteria = new CDbCriteria;
        $criteria->order = 'parent_id, sort';
        $models = self::model()->findAll($criteria);

        $_items['Default'][''] = 'OK';
        $_items['Non Permission']['200'] = 'Cuti';
        $_items['Non Permission']['300'] = 'Alpha';
        $_items['Non Permission']['400'] = 'Lembur';

        foreach ($models as $model)
            $_items[$model->category->name][$model->id] = $model->name . ' (' . $model->amount . ' days)';

        return $_items;
    }

}