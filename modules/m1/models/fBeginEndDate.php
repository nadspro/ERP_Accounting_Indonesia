<?php

class fBeginEndDate extends CFormModel {

    public $begindate;
    public $enddate;
    public $report_id;

    public function rules() {
        return array(
            array('begindate, enddate', 'required', 'on' => 'recruitment'),
            array('report_id', 'numerical', 'integerOnly' => true),
            array('begindate, enddate', 'type', 'type' => 'date', 'dateFormat' => 'dd-MM-yyyy'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'begindate' => 'Start Date',
            'enddate' => 'Finish Date',
            'report_id' => 'Report',
        );
    }

}
