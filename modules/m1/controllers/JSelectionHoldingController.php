<?php

class JSelectionHoldingController extends Controller {

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
            'rights', // perform access control for CRUD operations
            'postOnly + delete, deptUpdate', // we only allow deletion via POST request
        );
    }

    public function actionUpdateAssestment($id) {
        $model = $this->loadModelApplicantSelection($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hApplicantSelection'])) {
            $model->attributes = $_POST['hApplicantSelection'];
            if ($model->isNewRecord) {
                $model->parent_id = $id;
                $model->workflow_result_id = 22; //Psycho Test for Holding Only
            }

            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formAssestment', array('model' => $model, 'id' => $id));
    }

    public function actionDeleteAssestment($id) {
        $this->loadModelApplicantSelection($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        //if(!isset($_GET['ajax']))
        //	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $newParticipant = $this->newParticipant($id);

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'modelParticipant' => $newParticipant,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newParticipant($id) {
        $model = new jSelectionPart;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['jSelectionPart'])) {
            $model->attributes = $_POST['jSelectionPart'];
            $model->parent_id = $id;
            $model->flow_id = 1; //Applied, New Entry
            if ($model->save())
                $this->redirect(array('view', 'id' => $id));
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new jSelection;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['jSelection'])) {
            $model->attributes = $_POST['jSelection'];
            $model->company_id = sUser::model()->getGroup();
            if ($model->save())
            //$this->redirect(array('view','id'=>$model->id));
                $this->redirect(array('/m1/jSelectionHolding',));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['jSelection'])) {
            $model->attributes = $_POST['jSelection'];
            if ($model->save())
            //$this->redirect(array('view','id'=>$model->id));
                $this->redirect(array('/m1/jSelectionHolding',));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/m1/jSelectionHolding'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->render('index', array(
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = jSelection::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelApplicantSelection($id) {
        $model = hApplicantSelection::model()->findByPk($id);
        if ($model === null)
            $model = new hApplicantSelection;

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'j-selection-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCalendarEvents() {
        $criteria = new CDbCriteria;
        //$criteria->compare('company_id',1100);

        $models = jSelection::model()->findAll($criteria);

        $items = array();
        $detail = array();
        //$input = array("#CC0000", "#0000CC", "#333333", "#663333", "#993333","#CC3333","#003366","#663366","#993366","#CC3366","#6633CC");

        foreach ($models as $model) {

            if ($model->category_id == 1) {
                $color = "#CC0000";
            }
            else
                $color = "#0000CC";

            if ($model->company_id != 1100)
                $color = "#333333";

            $detail['title'] = $model->category->name . " (" . $model->partCount . ")";
            $detail['start'] = date('Y-m-d', strtotime($model->schedule_date));
            $detail['color'] = $color;
            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('/m1/jSelectionHolding/view', array("id" => $model->id));
            $items[] = $detail;
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionPersonAutoCompletePhoto() { //KELUAR ASAL UNIT///TO.DO
        $res = array();
        if (isset($_GET['term'])) {
            $qtxt = "SELECT applicant_name as label, c_pathfoto as photo, id FROM h_applicant 
			WHERE applicant_name LIKE :name 
			ORDER BY applicant_name LIMIT 20";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionDeleteParticipant($id) {
        $this->loadModelPart($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function loadModelPart($id) {
        $model = jSelectionPart::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionDeptUpdate() {
        $cat_id = $_POST['jSelectionPart']['company_id'];
        $models = aOrganization::model()->findAll(array('condition' => 'parent_id = ' . $cat_id, 'order' => 'id'));

        foreach ($models as $model) {
            foreach ($model->childs as $mod)
                foreach ($mod->childs as $m)
                //$_items[$m->getparent->getparent->name ." - ". $m->getparent->name][$m->id]=$m->name;
                    $_items[$m->id] = $m->name;
        }

        //$data=CHtml::listData($models,'id','name');

        foreach ($_items as $value => $dept) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($dept), true);
        }
    }

}
