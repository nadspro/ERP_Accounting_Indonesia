<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fSms extends CFormModel {

    public $hp;
    public $message;

    public function rules() {
        return array(
            // username and password are required
            array('hp, message', 'required'),
            array('hp', 'ext.BPhoneNumberValidator', 'onlyMobileNumbers' => true),
            array('hp', 'length', 'min' => 10),
            array('hp', 'length', 'max' => 13),
            array('message', 'length', 'max' => 480),
        );
    }

    public function beforeValidate() {

        if (substr($this->hp, 0, 2) == '08') {
            $this->hp = "628" . substr($this->hp, 3, 20);
        } elseif (substr($this->hp, 0, 3) == '+62')
            $this->hp = "62" . substr($this->hp, 4, 20);

        return true;
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'hp' => 'No HP',
            'm' => 'Message',
        );
    }

}
