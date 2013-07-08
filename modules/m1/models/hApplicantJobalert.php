<?php

/**
 * This is the model class for table "g_applicant_jobalert".
 *
 * The followings are the available columns in table 'g_applicant_jobalert':
 * @property integer $id
 * @property integer $parent_id
 * @property string $level_id
 * @property string $school_name
 * @property string $city
 * @property string $interest
 * @property string $graduate
 * @property string $country
 * @property string $ipk
 * @property string $category_id
 */
class hApplicantJobalert extends BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gEducation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'h_applicant_jobalert';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('specialization_id, status_id, ', 'required'),
            array('parent_id, specialization_id, status_id, last_email', 'numerical', 'integerOnly' => true),
            array('last_link', 'length', 'max' => 200),
            array('id, parent_id, specialization_id, status_id', 'safe', 'on' => 'search'),
            array('parent_id', 'unique', 'criteria' => array(
                    'condition' => '`specialization_id`=:specialization_id',
                    'params' => array(
                        ':specialization_id' => $this->specialization_id
                    )
                )),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'applicant' => array(self::BELONGS_TO, 'hApplicant', 'parent_id'),
            'specialization' => array(self::HAS_ONE, 'sParameter', array('code' => 'specialization_id'), 'condition' => 'type = "cRecruitmentSpec"'),
            'status' => array(self::HAS_ONE, 'sParameter', array('code' => 'status_id'), 'condition' => 'type = "cStatus"'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'specialization_id' => 'Specialization',
            'last_email' => 'Last Email',
            'last_link' => 'Link',
            'status_id' => 'Status',
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

        $criteria->compare('parent_id', Yii::app()->user->id);
        $criteria->order = 'specialization_id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
    }

    public function getTooManyJobalert() {

        $model = self::model()->count('status_id = 1 AND parent_id = ' . Yii::app()->user->id);

        if ($model > 4) {
            return true;
        }
        else
            return false;
    }

}