<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fInvitation extends CFormModel {

    public $datetime;
    public $place;
    public $pic;
    public $email;

    public function rules() {
        return array(
            // username and password are required
            array('datetime,place', 'required'),
            array('datetime', 'date', 'format' => 'dd-MM-yyyy HH:mm'),
            array('email,pic', 'length', 'max' => 100),
            array('place', 'length', 'max' => 300),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'datetime' => 'Date Time',
            'place' => 'Place',
            'pic' => 'Person to Meet',
        );
    }

}
