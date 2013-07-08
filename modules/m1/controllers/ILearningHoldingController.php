<?php

class ILearningHoldingController extends Controller {

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
            //'accessControl', // perform access control for CRUD operations
            'rights', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionViewDetail($id) {
        $newParticipant = $this->newParticipant($id);
        $newPhoto = $this->newPhoto($id);

        $this->render('viewDetail', array(
            'model' => $this->loadModelSchedule($id),
            'modelParticipant' => $newParticipant,
            'modelPhoto' => $newPhoto,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionConfirmAll($id) {
        $model = $this->loadModelSchedule($id);
        iLearningSchPart::model()->updateAll(array('flow_id' => 2, 'day1' => 1), 'parent_id = ' . $model->id);

        $newParticipant = $this->newParticipant($id);
        $newPhoto = $this->newPhoto($id);

        $this->render('viewDetail', array(
            'model' => $this->loadModelSchedule($id),
            'modelParticipant' => $newParticipant,
            'modelPhoto' => $newPhoto,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newParticipant($id) {
        $model = new iLearningSchPart;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearningSchPart'])) {
            $model->attributes = $_POST['iLearningSchPart'];
            $model->parent_id = $id;
            $model->flow_id = 1; //Applied, New Entry
            if ($model->save())
                $this->redirect(array('viewDetail', 'id' => $id));
        }

        return $model;
    }

    public function newPhoto($id) {
        $model = new fPhoto;

        if (isset($_POST['fPhoto'])) {

            $model->attributes = $_POST['fPhoto'];
            $model->datetime = date("d-m-Y");
            $model->title = "Dummy Title";
            $model->description = "Dummy Description";

            if ($model->validate()) {

                if (!is_dir(Yii::getPathOfAlias('webroot') . '/shareimages/hr/learning/' . $id))
                    mkdir(Yii::getPathOfAlias('webroot') . '/shareimages/hr/learning/' . $id);

                $images = CUploadedFile::getInstancesByName($model->images);

                if (isset($images) && count($images) > 0) {

                    foreach ($images as $image => $pic) {
                        $pic->saveAs(Yii::getPathOfAlias('webroot') . '/shareimages/hr/learning/' . $id . "/" . $pic->name);
                    }

                    //change permission
                    //chmod(Yii::getPathOfAlias('webroot').'/shareimages/photo/'.date("Ymd")."-".$model->title.".jpg","0777");
                    //$model= new fPhoto;
                }
            }
        }

        return $model;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $newSchedule = $this->newSchedule($id);

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'modelSchedule' => $newSchedule,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newSchedule($id) {
        $model = new iLearningSch;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearningSch'])) {
            $model->attributes = $_POST['iLearningSch'];
            $model->parent_id = $id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->parent_id));
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new iLearning;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearning'])) {
            $model->attributes = $_POST['iLearning'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionFeedback($id) {
        $model = iLearningSchPartFb::model()->find('parent_id =' . $id);
        $modelSch = iLearningSchPart::model()->findByPk((int) $id);

        if ($model === null)
            $model = new iLearningSchPartFb;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearningSchPartFb'])) {
            $model->attributes = $_POST['iLearningSchPartFb'];
            $model->parent_id = $id;
            if ($model->save())
                $this->redirect(array('viewDetail', 'id' => $model->getparent->parent_id));
        }

        $this->render('feedback', array(
            'model' => $model,
            'modelSch' => $modelSch,
        ));
    }

    public function actionUpdateSchedule($id) {
        $model = $this->loadModelSchedule($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearningSch'])) {
            $model->attributes = $_POST['iLearningSch'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formSchedule', array('model' => $model));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['iLearning'])) {
            $model->attributes = $_POST['iLearning'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionUpdateParticipantAjax() {
        $model->attributes = $_POST;
        $model = $this->loadModelSchedulePart($_POST['pk']);
        $model->$_POST['name'] = $_POST['value'];
        if ($model->save()) {
            return true;
        }
        else
            return false;
    }

    public function actionUpdateMandaysAjax() {
        $model->attributes = $_POST;
        $model = $this->loadModelSchedule($_POST['pk']);
        $model->$_POST['name'] = $_POST['value'];
        if ($model->save()) {
            return true;
        }
        else
            return false;
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteParticipant($id) {
        $this->loadModelSchedulePart($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionDeleteSchedule($id) {
        $this->loadModelSchedule($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/m1/iLearningHolding'));
    }

    public function actionPrintDetail($id) {
        $pdf = new learning1('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $model = iLearningSch::model()->findByPk((int) $id);
        if ($model == null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $pdf->report($model);

        $pdf->Output();
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->render('index', array(
        ));
    }

    public function actionCalendarEvents() {
        $criteria = new CDbCriteria;
        $criteria->compare('year(schedule_date)', date("Y"));

        $models = iLearningSch::model()->findAll($criteria);

        $items = array();
        $detail = array();
        $input = array("#CC0000", "#0000CC", "#333333", "#663333", "#993333", "#CC3333", "#003366", "#663366", "#993366", "#CC3366", "#6633CC");
        foreach ($models as $model) {
            $detail['title'] = $model->learning_status . " (" . $model->partCount . ")";
            $detail['start'] = date('Y') . '-' . date('m', strtotime($model->schedule_date)) . '-' . date('d', strtotime($model->schedule_date));
            //$detail['start']= $model->schedule_date;
            $detail['color'] = $input[rand(0, 10)];
            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('/m1/iLearningHolding/viewDetail', array("id" => $model->id));
            $items[] = $detail;
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

    /**
     * Lists all models.
     */
    public function actionIndex2() {
        $model = new iLearning('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;

        if (isset($_GET['iLearning'])) {
            $model->attributes = $_GET['iLearning'];
            $criteria->compare('learning_title', $_GET['iLearning']['learning_title'], true);
        }

        $criteria->order = 'learning_title';

        $dataProvider = new CActiveDataProvider('iLearning', array(
            'criteria' => $criteria,
        ));

        $this->render('index2', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex3() {
        $this->render('index3', array(
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = iLearning::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModelSchedule($id) {
        $model = iLearningSch::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelSchedulePart($id) {
        $model = iLearningSchPart::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'i-learning-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPersonAutoCompletePhoto() {
        $res = array();
        if (isset($_GET['term'])) {

            $qtxt = "select 
        `a`.`id` AS `id`,
        `a`.`employee_name` AS `label`,
        `a`.`c_pathfoto` AS `photo`,
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `c`
                left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
            where
                ((`a`.`id` = `c`.`parent_id`)
                    and (`c`.`status_id` in (" . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ")))
            order by `c`.`start_date` desc
            limit 1) AS `company`,
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `c`
                left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
            where
                ((`a`.`id` = `c`.`parent_id`)
                    and (`c`.`status_id` in (" . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ")))
            order by `c`.`start_date` desc
            limit 1) AS `department`,
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `s`
                left join `g_param_level` `o` ON ((`o`.`id` = `s`.`level_id`)))
            where
                (`s`.`parent_id` = `a`.`id`)
            order by `s`.`start_date` desc
            limit 1) AS `level`
    from
        `g_person` `a` WHERE `a`.`employee_name` LIKE :name 
			AND  (select `s`.`status_id` AS `status_id` from `g_person_status` `s` where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1) NOT IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ") 
			ORDER BY `a`.`employee_name` LIMIT 20
        ";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionLearningAutoComplete() {
        $res = array();
        if (isset($_GET['term'])) {
            $qtxt = "SELECT learning_title as label, id FROM i_learning 
			WHERE learning_title LIKE :name 
			ORDER BY learning_title LIMIT 20";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

}
