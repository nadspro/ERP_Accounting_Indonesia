<?php

/**
 * This is the model class for table "g_vacancy_applicant".
 *
 * The followings are the available columns in table 'g_vacancy_applicant':
 * @property integer $id
 * @property integer $applicant_id
 * @property integer $vacancy_id
 * @property integer $status_id
 */
class hVacancyApplicant extends BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GVacancyApplicant the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'h_vacancy_applicant';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('applicant_id, vacancy_id', 'required'),
            array('applicant_id, vacancy_id, status_id, email_status_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, applicant_id, vacancy_id, status_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'applicant' => array(self::BELONGS_TO, 'hApplicant', 'applicant_id'),
            'vacancy' => array(self::BELONGS_TO, 'hVacancy', 'vacancy_id'),
            'status' => array(self::BELONGS_TO, 'sParameter', array('status_id' => 'code'), 'condition' => 'type = \'cApplicantStatus\''),
            'comment' => array(self::HAS_MANY, 'hVacancyApplicantComment', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'applicant_id' => 'Applicant',
            'vacancy_id' => 'Vacancy',
            'status_id' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($id, $act) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('vacancy_id', $id);
        $criteria->compare('status_id', $act);
        $criteria->with = array('applicant');
        $criteria->order = 't.created_date DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
                //'pagination'=>array(
                //	'pageSize'=>20,
                //)
        ));
    }

    public function searchByApplicant($id) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('applicant_id', $id);
        $criteria->with = array('applicant');
        $criteria->order = 't.created_date DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
                //'pagination'=>array(
                //	'pageSize'=>20,
                //)
        ));
    }

    public static function getTopRecentInterview() {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->together = true;
        //$criteria->order="vacancy.created_date DESC";
        $criteria->compare('t.status_id', 4);
        $criteria->with = array('comment');

        if (Yii::app()->user->name != "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->with = array('vacancy');
            $criteria2->condition = 'vacancy.company_id IN (' . implode(",", sUser::model()->getGroupArray()) . ')';
            $criteria->mergeWith($criteria2);
        }


        $models = self::model()->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $returnarray[] = array('id' => $model->id, 'label' => $model->applicant->applicant_name . " - " . $model->vacancy->vacancy_title, 'icon' => 'list-alt', 'url' => array('/m1/hVacancy/interviewDetail', 'id' => $model->id));
        }

        return $returnarray;
    }

}
