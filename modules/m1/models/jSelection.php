<?php

/**
 * This is the model class for table "j_selection".
 *
 * The followings are the available columns in table 'j_selection':
 * @property integer $id
 * @property string $pic
 * @property integer $category_id
 * @property string $schedule_date
 * @property string $additional_info
 * @property integer $cost
 * @property integer $status_id
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class jSelection extends BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return jSelection the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'j_selection';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id', 'required'),
            array('category_id, company_id, cost, status_id, created_date, updated_date', 'numerical', 'integerOnly' => true),
            array('pic', 'length', 'max' => 100),
            array('additional_info', 'length', 'max' => 500),
            array('created_by, updated_by', 'length', 'max' => 50),
            array('schedule_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, pic, category_id, schedule_date, additional_info, cost, status_id, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'sParameter', array('category_id' => 'code'), 'condition' => 'type = \'cSelectionType\''),
            'status' => array(self::BELONGS_TO, 'sParameter', array('status_id' => 'code'), 'condition' => 'type = \'cTrainingStatus\''),
            'partCount' => array(self::STAT, 'jSelectionPart', 'parent_id'),
            'company' => array(self::BELONGS_TO, 'aOrganization', 'company_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'company_id' => 'Company',
            'pic' => 'Person In Charge',
            'category_id' => 'Category',
            'schedule_date' => 'Schedule Date',
            'additional_info' => 'Additional Info',
            'cost' => 'Cost',
            'status_id' => 'Status',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('pic', $this->pic, true);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('schedule_date', $this->schedule_date, true);
        $criteria->compare('additional_info', $this->additional_info, true);
        $criteria->compare('cost', $this->cost);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('created_date', $this->created_date);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('updated_date', $this->updated_date);
        $criteria->compare('updated_by', $this->updated_by, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}