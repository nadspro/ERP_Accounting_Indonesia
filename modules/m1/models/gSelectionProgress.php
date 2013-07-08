<?php

/**
 * This is the model class for table "g_selection_progress".
 *
 * The followings are the available columns in table 'g_selection_progress':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $workflow_id
 * @property string $workflow_date
 * @property string $workflow_by
 * @property integer $workflow_result_id
 * @property string $workflow_remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property GSelection $parent
 */
class gSelectionProgress extends BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gSelectionProgress the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'g_selection_progress';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('workflow_id, workflow_date', 'required'),
            array('parent_id, workflow_id, workflow_result_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true),
            array('workflow_by', 'length', 'max' => 50),
            //array('parent_id', 'UniqueAttributesValidator', 'with'=>'workflow_id'),			
            array('workflow_date, workflow_remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, parent_id, workflow_id, workflow_date, workflow_by, workflow_result_id, workflow_remark, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parent' => array(self::BELONGS_TO, 'GSelection', 'parent_id'),
            'workflow' => array(self::BELONGS_TO, 'gParamSelection', 'workflow_id'),
            'invitation_status' => array(self::BELONGS_TO, 'sParameter', array('workflow_result_id' => 'code'), 'condition' => 'type = \'cSelectionInvitation\''),
            'workflow_result' => array(self::BELONGS_TO, 'sParameter', array('workflow_result_id' => 'code'), 'condition' => 'type = \'cSelectionResult\''),
            'f_result' => array(self::BELONGS_TO, 'sParameter', array('workflow_result_id' => 'code'), 'condition' => 'type = \'cSelectionState\''),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'workflow_id' => 'Workflow',
            'workflow_date' => 'Date',
            'workflow_by' => 'By',
            'workflow_result_id' => 'Result',
            'workflow_remark' => 'Remark',
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
        $criteria->order = 'workflow_id';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getWorkflowResult() {
        if ($this->workflow_id == 1 || $this->workflow_id == 6 || $this->workflow_id == 8 || $this->workflow_id == 10) {
            $value = (isset($this->invitation_status)) ? $this->invitation_status->name : "";
        } elseif ($this->workflow_id == 19) {
            $value = (isset($this->f_result)) ? $this->f_result->name : "";
        } else {
            $value = (isset($this->workflow_result)) ? $this->workflow_result->name : "";
        }

        return $value;
    }

}