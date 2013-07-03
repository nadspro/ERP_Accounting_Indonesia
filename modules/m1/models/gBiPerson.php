<?php

/**
 * This is the model class for table "g_person".
 *
 * The followings are the available columns in table 'g_person':
 * @property integer $id
 * @property string $employee_name
 * @property string $birth_place
 * @property string $birth_date
 * @property integer $sex_id
 * @property integer $religion_id
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $pos_code
 * @property string $blood_id
 */

class gBiPerson extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return gPerson the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'g_bi_person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'employee_name' => 'Employee Name',
				'employee_code_global' => 'Employee ID',
				'birth_place' => 'Birth Place',
				'birth_date' => 'Birth Date',
				'age' => 'Age',
				'sex' => 'Gender',
				'religion' => 'Religion',
				'address1' => 'Address',
				'identity_address1' => 'Identity Address',
				//'pos_code' => 'Pos Code',
				'blood_id' => 'Blood',
				'home_phone' => 'Home Phone',
				'company_id' => 'Company ID',
				'company' => 'Company Name',
				'department' => 'Department Name',
				'level' => 'Level',
				'job_title' => 'Job Title',
				'employee_status' => 'Status',
				'employee_status_date' => 'Status Date',
				'join_date' => 'Join Date',
				'join_year' => 'LoS Year',
				'join_month' => 'LoS Month',
				'email' => 'email',
				'email2' => 'email2',
				'home_phone' => 'Home Phone',
				'handphone' => 'Hand Phone',
				'handphone2' => 'Hand Phone2',
				'account_number' => 'Account Number',
				'account_name' => 'Account Name',
				'bank_name' => 'Bank Name',
		);
	}
	
	public function getListField($withnull=null) {
		if (isset($withnull))
			$_listField['null']=null;
		
		$label=self::model()->attributeLabels();
		foreach (self::model()->tableSchema->columns as $val)
			$_listField[$val->name]=$label[$val->name];
		
		return $_listField;
	}
	
}