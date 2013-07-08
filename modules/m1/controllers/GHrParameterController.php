<?php

class GHrParameterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights',
        );
    }

    public function actionIndex() {
        $modelParamLevel = $this->newParamLevel();
        $modelParamPermission = $this->newParamPermission();
        $modelParamPayroll = $this->newParamPayroll();
        $modelParamBenefit = $this->newParamBenefit();
        $modelParamDeduction = $this->newParamDeduction();

        $this->render('index', array(
            'modelParamLevel' => $modelParamLevel,
            'modelParamPermission' => $modelParamPermission,
            'modelParamPayroll' => $modelParamPayroll,
            'modelParamBenefit' => $modelParamBenefit,
            'modelParamDeduction' => $modelParamDeduction,
        ));
    }

    public function newParamLevel() {
        $model = new gParamLevel;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamLevel'])) {
            $model->attributes = $_POST['gParamLevel'];
            $model->parent_id = 0;
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function newParamPayroll() {
        $model = new gParamPayroll;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamPayroll'])) {
            $model->attributes = $_POST['gParamPayroll'];
            $model->parent_id = 0;
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function newParamBenefit() {
        $model = new gParamBenefit;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamBenefit'])) {
            $model->attributes = $_POST['gParamBenefit'];
            $model->parent_id = 0;
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function newParamDeduction() {
        $model = new gParamDeduction;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamDeduction'])) {
            $model->attributes = $_POST['gParamDeduction'];
            $model->parent_id = 0;
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function actionUpdateParamLevelAjax() {
        $model->attributes = $_POST;
        $model = $this->loadModelParamLevel($_POST['pk']);
        $model->$_POST['name'] = $_POST['value'];
        if ($model->save()) {
            return true;
        }
        else
            return false;
    }

    public function actionDeleteParamLevel($id) {
        $this->loadModelParamLevel($id)->delete();
    }

    public function loadModelParamLevel($id) {
        $model = gParamLevel::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function newParamPermission() {
        $model = new gParamPermission;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamPermission'])) {
            $model->attributes = $_POST['gParamPermission'];
            $model->parent_id = 0;
            if ($model->save())
                $this->refresh();
        }

        return $model;
    }

    public function actionUpdateParamPermissionAjax() {
        $model->attributes = $_POST;
        $model = $this->loadModelParamPermission($_POST['pk']);
        $model->$_POST['name'] = $_POST['value'];
        if ($model->save()) {
            return true;
        }
        else
            return false;
    }

    public function actionDeleteParamPermission($id) {
        $this->loadModelParamPermission($id)->delete();
    }

    public function loadModelParamPermission($id) {
        $model = gParamPermission::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionUpdateApplicant() {
        $criteria = new CDbCriteria;
        $criteria->compare('status_id', 1);
        //$criteria->condition='(created_date - unix_timestamp)'; //itung yang lebih dari 14 hari

        hVacancyApplicant::model()->updateAll(array('status_id' => 3), $criteria);
    }

}
