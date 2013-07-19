<?php

class sParameter extends BaseModel {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 's_parameter';
    }

    public function rules() {
        return array(
            array('name, code, type', 'required'),
            array('code', 'numerical', 'integerOnly' => true),
            array('name, type', 'length', 'max' => 128),
            array('name, code, type', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'name' => 'Name',
            'code' => 'Code',
            'type' => 'Type',
        );
    }

    public function lastItem($type) {
        $_item = self::model()->find(array(
            'order' => 'code DESC',
            'condition' => 'type = :type ',
            'params' => array(':type' => $type),
        ));
        if (isset($_item)) {
            $_code = $_item->code + 1;
        }
        else
            $_code = false;

        return $_code;
    }

    public function search($type = null) {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('code', $this->code);
        $criteria->compare('type', $type);
        $criteria->order = 'type,code';

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function searchP() {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('code', $this->code);
        $criteria->compare('type', 'cPeriode');

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    private static $_items = array();

    public function itemsWithName($type) {

        $_items[$type] = array();
        $models = self::model()->findAll(array(
            'condition' => 'type=:type',
            'params' => array(':type' => $type),
        ));

        foreach ($models as $model)
            $_items[$type][$model->name] = $model->name;

        return $_items;
    }

    public function itemsWithAll($type) {

        $_items[$type] = array();
        $_items[$type][''] = 'ALL';
        $models = self::model()->findAll(array(
            'condition' => 'type=:type',
            'params' => array(':type' => $type),
        ));

        foreach ($models as $model)
            $_items[$type][$model->code] = $model->name;

        return $_items;
    }

    public static function items($type, $all = 0, $exception = array()) {
        if (!isset(self::$_items[$type]))
            self::loadItems($type, $all, $exception);
        return self::$_items[$type];
    }

    public static function item($type, $code) {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }

    private static function loadItems($type, $all = null, $exception = null) {
        self::$_items[$type] = array();
        $criteria = new CDbCriteria;
        $criteria->compare('type', $type);
        $criteria->addNotInCondition('code', $exception);
        $models = self::model()->findAll($criteria);

        if ($all != null)
            self::$_items[$type][0] = '*inherited*';

        foreach ($models as $model)
            self::$_items[$type][$model->code] = $model->name;
    }

    public function ItemsOther($type) {
        $_items = array();
        $models = self::model()->findAll(array(
            'condition' => 'type=:type',
            'params' => array(':type' => $type),
        ));

        foreach ($models as $model)
            $_items[$model->name] = $model->name;

        return $_items;
    }

    private static $_items3 = array();

    public static function items3($type) {
        if (!isset(self::$_items3[$type]))
            self::loadItems3($type);
        return self::$_items3[$type];
    }

    private static function loadItems3($type) {
        self::$_items3[$type] = array();
        $models = self::model()->findAllBySql('select distinct type from s_parameter');
        self::$_items3[$type][''] = '(ALL)';
        foreach ($models as $model)
            self::$_items3[$type][$model->type] = $model->type;
    }

    private static $_items2 = array();

    public static function items2($type) {
        if (!isset(self::$_items2[$type]))
            self::loadItems2($type);
        return self::$_items2[$type];
    }

    private static function loadItems2($type) {
        self::$_items2[$type] = array();
        $models = self::model()->findAllBySql('select distinct type from s_parameter');
        //self::$_items3[$type]['']='(ALL)';
        foreach ($models as $model)
            self::$_items2[$type][$model->type] = $model->type;
    }


    public function menuList($type, $route) {

        $criteria = new CDbCriteria;
        $criteria->compare('type', $type);
        $models = self::model()->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $returnarray[] = array('id' => $model->code, 'label' => $model->name, 'icon' => 'list-alt', 'url' => array('/' . $route . '/filter', 'id' => $model->code));
        }

        return $returnarray;
    }

}