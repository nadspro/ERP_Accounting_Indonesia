<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fPhoto extends CFormModel {

    public $datetime;
    public $title;
    public $description;
    public $images;

    public function rules() {
        return array(
            // username and password are required
            array('datetime,title, description', 'required'),
            array('datetime', 'date', 'format' => 'dd-MM-yyyy'),
            array('title', 'length', 'max' => 100),
            array('description', 'length', 'max' => 5000),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'datetime' => 'Date',
            'title' => 'Title',
            'description' => 'Description',
        );
    }

}
