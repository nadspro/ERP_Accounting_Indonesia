<?php

class GPersonController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /*
      public function filters()
      {
      return array(
      'accessControl', // perform access control for CRUD operations
      'ajaxOnly + PersonAutoComplete',
      array(
      'COutputCache +index',
      // will expire in a year
      'duration'=>24*3600*365,
      'dependency'=>array(
      'class'=>'CChainedCacheDependency',
      'dependencies'=>array(
      new CGlobalStateCacheDependency('gperson'),
      new CDbCacheDependency('SELECT id FROM g_person
      ORDER BY id DESC LIMIT 1'),
      ),
      ),
      ),
      );
      }
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights',
            'ajaxOnly + PersonAutoComplete,PersonAutoCompleteId,PersonAutoCompleteIdAdmin,
				CreateStatusAjax',
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $modelCareer = $this->newCareer($model->id);
        $modelFamily = $this->newFamily($model->id);
        $modelEducation = $this->newEducation($model->id);
        $modelEducationNf = $this->newEducationNf($model->id);
        $modelExperience = $this->newExperience($model->id);
        $modelTraining = $this->newTraining($model->id);
        $modelStatus = $this->newStatus($model->id);
        $modelOther = $this->newOther($model->id);
        $modelCareer2 = $this->newCareer2($model->id);

        $this->render('view', array(
            'model' => $model,
            'modelCareer' => $modelCareer,
            'modelFamily' => $modelFamily,
            'modelEducation' => $modelEducation,
            'modelEducationNf' => $modelEducationNf,
            'modelExperience' => $modelExperience,
            'modelTraining' => $modelTraining,
            'modelStatus' => $modelStatus,
            'modelOther' => $modelOther,
            'modelCareer2' => $modelCareer2,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newCareer($id) {
        $model = new gPersonCareer;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonCareer'])) {
            $model->attributes = $_POST['gPersonCareer'];
            $model->parent_id = $id;

            if ($model->save())
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Internal Career'));
        }

        return $model;
    }

    public function newCareer2($id) {
        $model = new gPersonCareer2;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonCareer2'])) {
            $model->attributes = $_POST['gPersonCareer2'];
            $model->parent_id = $id;

            if ($model->save())
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Assignment'));
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newFamily($id) {
        $model = new gPersonFamily;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonFamily'])) {
            $model->attributes = $_POST['gPersonFamily'];
            $model->parent_id = $id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Family'));
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newEducation($id) {
        $model = new gPersonEducation;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonEducation'])) {
            $model->attributes = $_POST['gPersonEducation'];
            $model->parent_id = $id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Education'));
        }

        return $model;
    }

    public function newEducationNf($id) {
        $model = new gPersonEducationNf;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonEducationNf'])) {
            $model->attributes = $_POST['gPersonEducationNf'];
            $model->parent_id = $id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Non Formal Edu'));
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newExperience($id) {
        $model = new gPersonExperience;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonExperience'])) {
            $model->attributes = $_POST['gPersonExperience'];
            $model->parent_id = $id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Experience'));
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newTraining($id) {
        $model = new gPersonTraining;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonTraining'])) {
            $model->attributes = $_POST['gPersonTraining'];
            $model->parent_id = $id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Training'));
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newStatus($id) {
        $model = new gPersonStatus;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonStatus'])) {
            $model->attributes = $_POST['gPersonStatus'];
            $model->parent_id = $id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Status'));
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newOther($id) {
        $model = new gPersonOther;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonOther'])) {
            $model->attributes = $_POST['gPersonOther'];
            $model->parent_id = $id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Other Info'));
        }

        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $model = new gPerson;
        $model->setScenario('create');
        $modelCareer = new gPersonCareer;
        $modelStatus = new gPersonStatus;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPerson'], $_POST['gPersonCareer'])) {
            $model->attributes = $_POST['gPerson'];
            $modelCareer->attributes = $_POST['gPersonCareer'];
            $modelStatus->attributes = $_POST['gPersonStatus'];

            $valid = $model->validate();
            $valid = $modelCareer->validate() && $valid;
            $valid = $modelStatus->validate() && $valid;

            if ($valid) {
                $model->save(false);
                $modelCareer->parent_id = $model->id;
                $modelCareer->save(false);
                $modelStatus->parent_id = $model->id;
                $modelStatus->save(false);

                $this->redirect(array('view', 'id' => $model->id));
            }
        }


        $this->render('create', array(
            'model' => $model,
            'modelCareer' => $modelCareer,
            'modelStatus' => $modelStatus,
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

        if (isset($_POST['gPerson'])) {
            $model->attributes = $_POST['gPerson'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionUpdateCareer($id) {
        $model = $this->loadModelCareer($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonCareer'])) {
            $model->attributes = $_POST['gPersonCareer'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formCareer', array('model' => $model));
    }

    public function actionUpdateCareer2($id) {
        $model = $this->loadModelCareer2($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonCareer2'])) {
            $model->attributes = $_POST['gPersonCareer2'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formCareer2', array('model' => $model));
    }

    public function actionUpdateFamily($id) {
        $model = $this->loadModelFamily($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonFamily'])) {
            $model->attributes = $_POST['gPersonFamily'];
            if ($model->save())
            //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formFamily', array('model' => $model));
    }

    public function actionUpdateEducation($id) {
        $model = $this->loadModelEducation($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonEducation'])) {
            $model->attributes = $_POST['gPersonEducation'];
            if ($model->save())
            //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formEducation', array('model' => $model));
    }

    public function actionUpdateEducationNf($id) {
        $model = $this->loadModelEducationNf($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonEducationNf'])) {
            $model->attributes = $_POST['gPersonEducationNf'];
            if ($model->save())
            //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formEducationNf', array('model' => $model));
    }

    public function actionUpdateExperience($id) {
        $model = $this->loadModelExperience($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonExperience'])) {
            $model->attributes = $_POST['gPersonExperience'];
            if ($model->save())
            //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formExperience', array('model' => $model));
    }

    public function actionUpdateTraining($id) {
        $model = $this->loadModelTraining($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonTraining'])) {
            $model->attributes = $_POST['gPersonTraining'];
            if ($model->save())
            //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formTraining', array('model' => $model));
    }

    public function actionUpdateStatus($id) {
        $model = $this->loadModelStatus($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonStatus'])) {
            $model->attributes = $_POST['gPersonStatus'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formStatus', array('model' => $model));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateOther($id) {
        $model = $this->loadModelOther($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonOther'])) {
            $model->attributes = $_POST['gPersonOther'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formOther', array('model' => $model));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/m1/gPerson'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDeleteCareer($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelCareer($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', "id" => $model->parent_id));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDeleteCareer2($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelCareer2($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', "id" => $model->parent_id));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDeleteFamily($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelFamily($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', "id" => $model->parent_id));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDeleteEducation($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelEducation($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', "id" => $model->parent_id));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDeleteEducationNf($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelEducationNf($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', "id" => $model->parent_id));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDeleteExperience($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelExperience($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', "id" => $model->parent_id));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDeleteTraining($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelTraining($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', "id" => $model->parent_id));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDeleteStatus($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelStatus($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', "id" => $model->parent_id));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteOther($id) {
        $this->loadModelOther($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->layout = '//layouts/column3filter';

        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;

        if (Yii::app()->user->name != "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
                    implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                    ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                    implode(",", sUser::model()->getGroupArray()) . ') OR ' .
                    '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
                    implode(",", sUser::model()->getGroupArray()) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                    implode(",", sUser::model()->getGroupArray()) . ')';
            $criteria->mergeWith($criteria2);
        }

        if (isset($_GET['pid']) && ($_GET['pid'] != null)) {
            $criteria->condition = '(select c.department_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) = ' . $_GET['pid'];
        }

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1 = new CDbCriteria;
            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('address1',$_GET['gPerson']['address1'],true,'OR');
            $criteria->mergeWith($criteria1);
        }

        $criteria->order = 'updated_date DESC';

        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM g_person');

        //$dataProvider=new CActiveDataProvider('gPerson', array(
        $dataProvider = new CActiveDataProvider(gPerson::model()->cache(3600, $dependency, 2), array(
            'criteria' => $criteria,
                )
        );

        Yii::app()->user->setFlash('info', '<strong>Selamat Berpuasa!</strong> Team APHRIS mengucapkan selamat menjalankan ibadah puasa... ');

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionUpdatePersonAjax() {
        $model->attributes = $_POST;
        $model = $this->loadModel($_POST['pk']);
        $model->$_POST['name'] = $_POST['value'];
        if ($model->save()) {
            return true;
        }
        else
            return false;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $criteria = new CDbCriteria;

        if (Yii::app()->user->name != "admin") {
            $criteria->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
                    implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                    ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                    implode(",", sUser::model()->getGroupArray()) . ') OR ' .
                    '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
                    implode(",", sUser::model()->getGroupArray()) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                    implode(",", sUser::model()->getGroupArray()) . ')';
        }

        $model = gPerson::model()->findByPk((int) $id, $criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelCareer($id) {

        $model = gPersonCareer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelCareer2($id) {

        $model = gPersonCareer2::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelFamily($id) {
        $model = gPersonFamily::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelEducation($id) {
        $model = gPersonEducation::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelEducationNf($id) {
        $model = gPersonEducationNf::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelExperience($id) {
        $model = gPersonExperience::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelTraining($id) {
        $model = gPersonTraining::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelStatus($id) {
        $model = gPersonStatus::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModelOther($id) {
        $model = gPersonOther::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'g-person-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPersonAutoComplete() {


        $res = array();
        if (isset($_GET['term'])) {
            if (Yii::app()->user->name != "admin") {
                $qtxt = 'SELECT DISTINCT a.employee_name FROM g_person a
			WHERE a.employee_name LIKE :name AND ' .
                        '((select c.company_id from g_person_career c WHERE a.id=c.parent_id AND c.status_id IN (' .
                        implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                        ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') OR ' .
                        '(select c2.company_id from g_person_career2 c2 WHERE a.id=c2.parent_id AND c2.company_id IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ')) ' .
                        'ORDER BY a.employee_name LIMIT 20';
            } else {
                $qtxt = "SELECT DISTINCT a.employee_name FROM g_person a
			WHERE a.employee_name LIKE :name
			ORDER BY a.employee_name LIMIT 20";
            }
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
            //$res =$command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPersonAutoCompleteId() {
        $res = array();
        if (isset($_GET['term'])) {
            if (Yii::app()->user->name != "admin") {
                $qtxt = 'SELECT CONCAT(a.employee_name," (",a.employee_code_global,")") as label, a.id as id FROM g_person a
			WHERE a.employee_name LIKE :name AND ' .
                        '((select c.company_id from g_person_career c WHERE a.id=c.parent_id AND c.status_id IN (' .
                        implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                        ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') OR ' .
                        '(select c2.company_id from g_person_career2 c2 WHERE a.id=c2.parent_id AND c2.company_id IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ')) ' .
                        'ORDER BY a.employee_name LIMIT 20';
            } else {
                $qtxt = "SELECT CONCAT(employee_name,' (',employee_code,')') as label, id FROM g_person 
			WHERE employee_name LIKE :name 
			ORDER BY employee_name LIMIT 20";
            }
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPersonAutoCompletePhoto() {
        $res = array();
        if (isset($_GET['term'])) {
            if (Yii::app()->user->name != "admin") {
                $qtxt = 'SELECT a.employee_name as label, c_pathfoto as photo, a.id as id FROM g_person a
			WHERE a.employee_name LIKE :name AND' .
                        '((select c.company_id from g_person_career c WHERE a.id=c.parent_id AND c.status_id IN (' .
                        implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                        ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') OR ' .
                        '(select c2.company_id from g_person_career2 c2 WHERE a.id=c2.parent_id AND c2.company_id IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ')) ' .
                        'ORDER BY a.employee_name LIMIT 20';
            } else {
                $qtxt = "SELECT employee_name as label, c_pathfoto as photo, id FROM g_person 
			WHERE employee_name LIKE :name 
			ORDER BY employee_name LIMIT 20";
            }
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPersonAutoCompletePhotoActive() {
        $res = array();
        if (isset($_GET['term'])) {
            if (Yii::app()->user->name != "admin") {
                $qtxt = 'SELECT a.employee_name as label, c_pathfoto as photo, a.id as id FROM g_person a
			WHERE a.employee_name LIKE :name AND ' .
                        '(select s.status_id from g_person_status s WHERE a.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
			(' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
                        '((select c.company_id from g_person_career c WHERE a.id=c.parent_id AND c.status_id IN (' .
                        implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                        ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') OR ' .
                        '(select c2.company_id from g_person_career2 c2 WHERE a.id=c2.parent_id AND c2.company_id IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ')) ' .
                        'ORDER BY a.employee_name LIMIT 20';
            } else {
                $qtxt = "SELECT employee_name as label, c_pathfoto as photo, id FROM g_person 
			WHERE employee_name LIKE :name 
			ORDER BY employee_name LIMIT 20";
            }
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPersonAutoCompleteIdAdmin() {
        $res = array();
        if (isset($_GET['term'])) {
            //$qtxt = "SELECT CONCAT(employee_name,' (',employee_code_global,')') as label, id FROM g_person 
			//WHERE employee_name LIKE :name 
			//ORDER BY employee_name LIMIT 20";
			$qtxt="
				select 
					`a`.`id` AS `id`,
					CONCAT( `a`.`employee_name`,' | ',
					(select 
							`o`.`branch_code` AS `name`
						from
							(`erp_apl`.`g_person_career` `c`
							left join `erp_apl`.`a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
						where
							((`a`.`id` = `c`.`parent_id`)
								and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
						order by `c`.`start_date` desc
						limit 1) ,' | ',
					(select 
							`o`.`name` AS `name`
						from
							(`erp_apl`.`g_person_career` `c`
							left join `erp_apl`.`a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
						where
							((`a`.`id` = `c`.`parent_id`)
								and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
						order by `c`.`start_date` desc
						limit 1))  AS `label`
				from
					`erp_apl`.`g_person` `a`
				WHERE `a`.`employee_name` LIKE :name 
				ORDER BY `employee_name` LIMIT 20";


            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionDeptUpdate() {
        $cat_id = $_POST['gPersonCareer']['company_id'];
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

    public function actionDeptUpdate2() {
        $cat_id = $_POST['gPersonCareer2']['company_id'];
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

    public function actionUpload($id) {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        //$folder='shareimages/hr/employee/temp/';  // folder for uploaded files
        $folder = 'shareimages/hr/employee/';  // folder for uploaded files
        $allowedExtensions = array("jpg");  //array("jpg","jpeg","gif","exe","mov" and etc...
        //$sizeLimit = 5 * 1024 * 1024;// maximum file size in bytes
        $sizeLimit = 500 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
        $fileName = $result['filename']; //GETTING FILE NAME
        //Make Thumb
        //copy(Yii::getPathOfAlias('webroot').'shareimages/hr/employee/'.$fileName, 
        //Yii::getPathOfAlias('webroot').'shareimages/hr/employee/thumb/'.$fileName);
        //Yii::import('ext.iwi.Iwi');
        //$picture = new Iwi(Yii::app()->basePath . "/../shareimages/hr/employee/".$fileName);
        //$picture->resize(150,250, Iwi::AUTO);
        //$picture->save(Yii::app()->basePath . "/../shareimages/hr/employee/thumb/".$fileName, TRUE);
        //change permission
        //chmod(Yii::getPathOfAlias('webroot').'shareimages/hr/employee/thumb/'.$fileName,"0777");
        //gPerson::model()->updateByPk($id,array('c_pathfoto'=>$id."-".$fileName,'updated_date'=>time(),'updated_by'=>Yii::app()->user->id));
        gPerson::model()->updateByPk($id, array('c_pathfoto' => $fileName, 'updated_date' => time(), 'updated_by' => Yii::app()->user->id));

        echo $return; // it's array
    }

    public function actionPrintProfile($id) {
        $pdf = new profile('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        //$model=gPerson::model()->findByPk((int)$id);
        $pdf->report($id);

        $pdf->Output();
    }

    public function actionUpdateSso($id) {
        $random = peterFunc::rand_string(16);
        $_time = strtotime("+1 week");
        gPerson::model()->updateByPk($id, array('activation_code' => $random, 'activation_expire' => $_time));

        $this->redirect(array('view', "id" => $id));
    }

    public function actionUpdateCareerAjax($id) {
        $model = new gPersonCareer;

        if (isset($_POST['gPersonCareer'])) {
            $model->attributes = $_POST['gPersonCareer'];
            $model->parent_id = $id;

            if ($model->save())
                return true;
        }
        return false;
    }

    public function actionCreateCareerAjax($id) {
        $model = new gPersonCareer;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPersonCareer'])) {
            $model->attributes = $_POST['gPersonCareer'];
            $model->parent_id = $id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Internal Career'));
            }
        }

        EQuickDlgs::render('_formCareer', array('model' => $model));
    }

    public function actionCreateStatusAjax($id) {
        $model = new gPersonStatus;

        if (isset($_POST['gPersonStatus'])) {
            $model->attributes = $_POST['gPersonStatus'];
            $model->parent_id = $id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Status'));
            }
        }

        EQuickDlgs::render('_formStatus', array('model' => $model));
    }

    public function actionCreateExperienceAjax($id) {
        $model = new gPersonExperience;

        if (isset($_POST['gPersonExperience'])) {
            $model->attributes = $_POST['gPersonExperience'];
            $model->parent_id = $id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Experience'));
            }
        }

        EQuickDlgs::render('_formExperience', array('model' => $model));
    }

    public function actionCreateTrainingAjax($id) {
        $model = new gPersonTraining;

        if (isset($_POST['gPersonTraining'])) {
            $model->attributes = $_POST['gPersonTraining'];
            $model->parent_id = $id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Training'));
            }
        }

        EQuickDlgs::render('_formTraining', array('model' => $model));
    }

    public function actionCreateFamilyAjax($id) {
        $model = new gPersonFamily;

        if (isset($_POST['gPersonFamily'])) {
            $model->attributes = $_POST['gPersonFamily'];
            $model->parent_id = $id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Family'));
            }
        }

        EQuickDlgs::render('_formFamily', array('model' => $model));
    }

    public function actionCreateEducationAjax($id) {
        $model = new gPersonEducation;

        if (isset($_POST['gPersonEducation'])) {
            $model->attributes = $_POST['gPersonEducation'];
            $model->parent_id = $id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Education'));
            }
        }

        EQuickDlgs::render('_formEducation', array('model' => $model));
    }

    public function actionCreateEducationNfAjax($id) {
        $model = new gPersonEducationNf;

        if (isset($_POST['gPersonEducationNf'])) {
            $model->attributes = $_POST['gPersonEducationNf'];
            $model->parent_id = $id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Non Formal Edu'));
            }
        }

        EQuickDlgs::render('_formEducationNf', array('model' => $model));
    }

    public function actionCreateAssignmentAjax($id) {
        $model = new gPersonCareer2;

        if (isset($_POST['gPersonCareer2'])) {
            $model->attributes = $_POST['gPersonCareer2'];
            $model->parent_id = $id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Assignment'));
            }
        }

        EQuickDlgs::render('_formCareer2', array('model' => $model));
    }

    public function actionCreateOtherAjax($id) {
        $model = new gPersonOther;

        if (isset($_POST['gPersonOther'])) {
            $model->attributes = $_POST['gPersonOther'];
            $model->parent_id = $id;

            if ($model->save()) {
                EQuickDlgs::checkDialogJsScript();
                $this->redirect(array('view', 'id' => $id, 'tab' => 'Other Info'));
            }
        }

        EQuickDlgs::render('_formOther', array('model' => $model));
    }

}
