<?php

class Default2Controller extends Controller {

    public $layout = '//layouts/main';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights',
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionUncomplete() {
        $this->render('uncomplete');
    }

    public function actionCompTotalEmployee() {
        $this->render('compTotalEmployee');
    }

    public function actionCompCompanyType() {
        $this->render('compCompanyType');
    }

    public function actionCompByProfile() {
        $this->render('compByProfile');
    }

    public function actionCompByCareer() {
        $this->render('compByCareer');
    }

}