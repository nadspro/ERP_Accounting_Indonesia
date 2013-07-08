<?php

/**
 * This is the model class for table "g_payroll_benefit".
 *
 * The followings are the available columns in table 'g_payroll_benefit':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $yearmonth_start
 * @property integer $yearmonth_end
 * @property integer $benefit_id
 * @property string $remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property GPayroll $parent
 */
class gPayrollBenefit extends BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPayrollBenefit the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'g_payroll_benefit';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('benefit_id, yearmonth_start,amount', 'required'),
            array('parent_id, yearmonth_start, yearmonth_end, benefit_id, amount, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true),
            array('remark', 'length', 'max' => 300),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, parent_id, yearmonth_start, yearmonth_end, benefit_id, remark, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parent' => array(self::BELONGS_TO, 'gPerson', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'yearmonth_start' => 'Start',
            'yearmonth_end' => 'End',
            'benefit_id' => 'Benefit',
            'amount' => 'Amount',
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