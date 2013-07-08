<?php

/**
 * This is the model class for table "i_learning_sch_part".
 *
 * The followings are the available columns in table 'i_learning_sch_part':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $employee_id
 * @property integer $flow_id
 * @property integer $created_date
 * @property string $created_by
 */
class jSelectionPart extends BaseModel {

    public $applicant_name;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return iLearningSchPart the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'j_selection_part';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id, applicant_id, flow_id, company_id, department_id, level_id, for_position', 'required'),
            array('parent_id, applicant_id, flow_id, company_id, department_id, level_id, created_date', 'numerical', 'integerOnly' => true),
            array('created_by', 'length', 'max' => 50),
            array('remark', 'length', 'max' => 500),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('parent_id, applicant_id, flow_id, created_date, created_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'getparent' => array(self::BELONGS_TO, 'jSelection', 'parent_id'),
            'applicant' => array(self::BELONGS_TO, 'hApplicant', 'applicant_id'),
            'flow' => array(self::BELONGS_TO, 'sParameter', array('flow_id' => 'code'), 'condition' => 'type = \'cTrainingRegister\''),
            'company' => array(self::BELONGS_TO, 'aOrganization', 'company_id'),
            'department' => array(self::BELONGS_TO, 'aOrganization', 'department_id'),
            'level' => array(self::BELONGS_TO, 'gParamLevel', 'level_id'),
            'created' => array(self::BELONGS_TO, 'sUser', 'created_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'applicant_id' => 'Applicant Name',
            'employee_name' => 'Applicant Name',
            'company_id' => 'Company',
            'department_id' => 'Department',
            'level_id' => 'Level',
            'for_position' => 'For Position',
            'flow_id' => 'Status',
            'remark' => 'Remark',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
        );
    }

    public function search($id) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->with = array('applicant');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => 't.created_date DESC',
            )
        ));
    }

    public function searchByEmp($id) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('applicant_id', $id);
        $criteria->with = array('getparent');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'getparent.schedule_date',
            )
        ));
    }

    public function searchByEmployee($id) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('applicant_id', $id);
        $criteria->with = array('getparent');
        $criteria->compare('flow_id', 2);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => 'getparent.schedule_date',
            )
        ));
    }

}