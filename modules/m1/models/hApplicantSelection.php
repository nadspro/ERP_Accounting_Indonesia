<?php

/**
 * This is the model class for table "h_vacancy_applicant_comment".
 *
 * The followings are the available columns in table 'h_vacancy_applicant_comment':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $user_id
 * @property integer $status_id
 * @property string $comment
 * @property integer $created_date
 * @property integer $created_by
 */
class hApplicantSelection extends BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return HVacancyApplicantComment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'h_applicant_selection';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id, assestment_date, assestment_summary, development_area', 'required'),
            array('parent_id, created_date, workflow_id, workflow_result_id, created_by', 'numerical', 'integerOnly' => true),
            array('workflow_by', 'length', 'max' => 30),
            array('id, parent_id, assestment_summary, assestment_date, development_area, created_date, created_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'workflow' => array(self::BELONGS_TO, 'gParamSelection', 'workflow_id'),
            'workflow_result3' => array(self::BELONGS_TO, 'sParameter', array('workflow_result_id' => 'code'), 'condition' => 'type = \'cSelectionState\''),
            'workflow_result' => array(self::BELONGS_TO, 'sParameter', array('workflow_result_id' => 'code'), 'condition' => 'type = \'cSelectionResult\''),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'workflow_id' => 'Work Flow',
            'workflow_by' => 'Assest By',
            'workflow_result_id' => 'Work Flow Result',
            'assestment_date' => 'Assestment Date',
            'assestment_summary' => 'Assestment Summary',
            'development_area' => 'Development Area',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
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