<?php

/**
 * This is the model class for table "i_learning_sch_part".
 *
 * The followings are the available columns in table 'i_learning_sch_part':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $employee_id
 * @property integer $flow_id
 * @property integer $day1
 * @property integer $day2
 * @property integer $day3
 * @property integer $day4
 * @property integer $created_date
 * @property string $created_by
 */
class iLearningSchPart extends BaseModel {

    public $employee_name;

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
        return 'i_learning_sch_part';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id, employee_id, flow_id', 'required'),
            array('parent_id, employee_id, flow_id, day1, day2, day3, day4, created_date', 'numerical', 'integerOnly' => true),
			array('parent_id', 'UniqueAttributesValidator', 'with'=>'employee_id'),
            array('created_by', 'length', 'max' => 50),
            array('remark', 'length', 'max' => 500),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('parent_id, employee_id, flow_id, day1, day2, day3, day4, created_date, created_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'getparent' => array(self::BELONGS_TO, 'iLearningSch', 'parent_id'),
            'employee' => array(self::BELONGS_TO, 'gPerson', 'employee_id'),
            'flow' => array(self::BELONGS_TO, 'sParameter', array('flow_id' => 'code'), 'condition' => 'type = \'cTrainingRegister\''),
            'feedbackCount' => array(self::STAT, 'iLearningSchPartFb', 'parent_id', 'select' => 'sum(A1+A2+A3+A4+A5+B1+B2+B3+B4+C1+C2)'),
            'feedbackCountFb' => array(self::STAT, 'iLearningSchPartFb', 'parent_id'),
            'feedback' => array(self::HAS_ONE, 'iLearningSchPartFb', 'parent_id'),
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
            'employee_id' => 'Employee Name',
            'employee_name' => 'Employee Name',
            'flow_id' => 'Status',
            'day1' => 'Day1',
            'day2' => 'Day2',
            'day3' => 'Day3',
            'day4' => 'Day4',
            'remark' => 'Remark',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
        );
    }

    public function getResultFeedback() {
        $result = $this->feedbackCount / 11;
        if ($result == 0) {
            $_return = "::Not Set::";
        } elseif ($result > 0 && $result <= 1.60) {
            $_return = "Very Bad";
        } elseif ($result >= 1.61 && $result <= 2.20) {
            $_return = "Bad";
        } elseif ($result >= 2.21 && $result <= 2.80) {
            $_return = "Good";
        }
        else
            $_return = "Very Good";

        return $_return;
    }

    public function searchHolding($id) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->with = array('employee');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => 'employee.employee_name',
            )
        ));
    }

    public function search($id) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->with = array('employee');

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.employee_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->getGroupArray()) . ')';
        $criteria->mergeWith($criteria2);
        //}


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => 'employee.employee_name',
            )
        ));
    }

    public function searchByEmployee($id) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('employee_id', $id);
        $criteria->with = array('getparent');
        $criteria->compare('flow_id', 2);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            //'sort' => array(
            //    'defaultOrder' => 'getparent.schedule_date',
            //)
        ));
    }
    
    public function afterSave() {
        if ($this->isNewRecord && strtotime($this->getparent->schedule_date) > time()) {
            Notification::create(
                    3, //Learning Group 
                    'm1/iLearning/viewDetail/id/' . $this->parent_id, 
                    strtoupper($this->employee->employee_name).' from '.$this->employee->mCompany(). ' has been added to ' 
                    . strtoupper($this->getparent->getparent->learning_title).' on '
                    . $this->getparent->schedule_date
            );
        }
        return true;
    }
    
    

}