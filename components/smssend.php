<?php

Yii::import('zii.widgets.CPortlet');

class smssend extends CPortlet {

    public function init() {
        $this->title = 'Send SMS';
        parent::init();
    }

    protected function renderContent() {
        $this->render('smssend');
    }

}

//TESTING ADD NEW COMMENT
//HOPE THIS WORK AND THANK FOR SYNC
?>
