<?php

/**
 * This is the model class for table "g_payroll".
 *
 * The followings are the available columns in table 'g_payroll':
 * @property integer $id
 * @property integer $basic_salary
 * @property string $remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 * @property GPayrollBenefit[] $gPayrollBenefits
 * @property GPayrollDeduction[] $gPayrollDeductions
 */
class gPayroll extends BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPayroll the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'g_payroll';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('basic_salary, yearmonth_start', 'required'),
            array('category_id, basic_salary, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true),
            array('remark', 'length', 'max' => 300),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, basic_salary, remark, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'person' => array(self::HAS_ONE, 'gPerson', 'id'),
            'category' => array(self::BELONGS_TO, 'gParamPayroll', 'category_id'),
            'benefit' => array(self::HAS_MANY, 'gPayrollBenefit', 'parent_id'),
            'deduction' => array(self::HAS_MANY, 'gPayrollDeduction', 'parent_id'),
            'deduction' => array(self::HAS_MANY, 'gPayrollDeduction', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'yearmonth_start' => 'Year Month',
            'category_id' => 'Catagory',
            'basic_salary' => 'Basic Salary',
            'remark' => 'Remark',
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
    public function search($id) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}