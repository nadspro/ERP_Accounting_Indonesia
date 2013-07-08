<?php

class fEmail extends CFormModel {

    public $name;
    public $username;
    public $receiver;
    public $email;
    public $useremail;
    public $subject;
    public $body;
    public $verifyCode;

    public function rules() {
        return array(
            array('subject, body', 'required'),
            array('useremail, email', 'email'),
            array('receiver', 'ext.MultiEmailValidator', 'delimiter' => ',', 'min' => 1, 'max' => 5),
            array('verifyCode', 'captcha', 'allowEmpty' => !extension_loaded('gd'), 'on' => 'help'),
        );
    }

    public function attributeLabels() {
        return array(
            'username' => 'User Name',
            'useremail' => 'Email User',
            'receiver' => 'Receiver',
            'verifyCode' => 'Verification Code',
        );
    }

}