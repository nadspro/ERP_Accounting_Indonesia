<?php

/**
 * This is the model class for table "g_person_performance".
 *
 * The followings are the available columns in table 'g_person_performance':
 * @property integer $id
 * @property integer $parent_id
 * @property string $input_date
 * @property integer $year
 * @property string $predicate
 * @property string $remark
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 */
class gTalentPerformance extends BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPersonPerformance the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'g_talent_performance';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id, input_date, year,amount, predicate', 'required'),
            array('input_date', 'date', 'format' => 'dd-MM-yyyy'),
            array('parent_id, year', 'numerical', 'integerOnly' => true),
            array('predicate', 'length', 'max' => 1),
            array('remark', 'length', 'max' => 300),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, parent_id, input_date, year, predicate, remark', 'safe', 'on' => 'search'),
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
            'input_date' => 'Input Date',
            'year' => 'Year',
            'amount' => 'Amount',
            'predicate' => 'Predicate',
            'remark' => 'Remark',
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
            'pagination' => false,
        ));
    }

    public function valPerformance() {
        if ($this->amount >= 1 && $this->amount <= 2.9) {
            $_val = "Low Performer";
        } elseif ($this->amount >= 3 && $this->amount <= 4.4) {
            $_val = "Mid Performer";
        } elseif ($this->amount >= 4.5 && $this->amount <= 5) {
            $_val = "High Performer";
        }
        else
            $_val = "ERROR";

        return $_val;
    }

}