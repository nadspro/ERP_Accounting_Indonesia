<?php

class GAttendanceController extends Controller {

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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $month = 0) {
        $modelAttendance = $this->newattendance($id, $month);

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'month' => $month,
            'modelAttendance' => $modelAttendance,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function newAttendance($id, $month) {
        $model = new gAttendance;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gAttendance'])) {
            $model->attributes = $_POST['gAttendance'];
            $model->parent_id = $id;
            $model->save();
            $this->refresh();
        }

        return $model;
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

        //Yii::app()->user->setFlash('info','<strong>Upload Photo!</strong> Upload Photo yang tadinya bermasalah sekarang sudah bisa digunakan.. ');

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateAttendance($id) {
        $model = $this->loadmodelAttendance($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gAttendance'])) {
            $model->attributes = $_POST['gAttendance'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formAttendance', array('model' => $model));
    }

    public function actionDeleteAttendance($id) {
        $model = $this->loadmodelAttendance($id);
        $model->delete();
    }

    public function actionSetTad($id) {
        $model = $this->loadmodelAttendance($id);
        $model->daystatus1_id = 13;
        $model->save(false);
    }

    public function actionSetTap($id) {
        $model = $this->loadmodelAttendance($id);
        $model->daystatus1_id = 14;
        $model->save(false);
    }

    public function actionSetSakit($id) {
        $model = $this->loadmodelAttendance($id);
        $model->daystatus1_id = 10;
        $model->save(false);
    }

    //NON PERMISSION DAY STATUS 3
    public function actionSetOk($id) {
        $model = $this->loadmodelAttendance($id);
        $model->daystatus3_id = 100;
        $model->save(false);
    }

    public function actionSetLembur($id) {
        $model = $this->loadmodelAttendance($id);
        $model->daystatus3_id = 400;
        //$model->overtime_out=strtotime($model->out) - strtotime($model->realpattern->out);
        $model->overtime_out = 120;
        $model->save(false);
    }

    public function actionSetCuti($id) {
        $model = $this->loadmodelAttendance($id);
        $model->daystatus3_id = 200;
        $model->save(false);
    }

    public function actionSetAlpha($id) {
        $model = $this->loadmodelAttendance($id);
        $model->daystatus3_id = 300;
        $model->save(false);
    }

    public function actionSetClear($id) {
        $model = $this->loadmodelAttendance($id);
        $model->daystatus1_id = null;
        $model->daystatus2_id = null;
        $model->daystatus3_id = null;
        $model->save(false);
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

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadmodelAttendance($id) {
        $criteria = new CDbCriteria;

        $model = gAttendance::model()->findByPk((int) $id, $criteria);
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

    public function actionPrintDetail($id, $month) {
        $pdf = new attendanceDetail('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('cdate', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        //$criteria->compare('cdate',$this->cdate,true);
        //$criteria->compare('realpattern_id',$this->realpattern_id);
        //$criteria->compare('daystatus1_id',$this->daystatus1_id);
        //$criteria->compare('in',$this->in,true);
        //$criteria->compare('out',$this->out,true);
        $criteria->order = 'cdate';
        $criteria->with = 'realpattern';
        $criteria->select = 'CASE WHEN TIME(realpattern.in) < TIME(t.in) THEN "Late In" ELSE "" END as lateIn,
		CASE WHEN TIME(realpattern.out) > TIME(t.out) THEN "Early Out" ELSE "" END as earlyOut, *';

        $models = gAttendance::model()->findAll($criteria);
        if ($models == null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $pdf->report($models);

        $pdf->Output();
    }

    public function actionTimeblock($flash = "off") {
        Yii::import('ext.phpexcelreader.JPhpExcelReader');
        $file = Yii::app()->basePath . '/../sharedocs/temporarydocuments/schedule.xls';
        if (is_file($file)) {
            $this->layout = '//layouts/column1';

            $reader = new JPhpExcelReader($file);

            foreach ($reader->sheets as $k => $data) {
                if ($k == 0) {
                    foreach ($data['cells'] as $r => $row) {
                        if ($r == 1) {
                            $h = array('parent_id', 'begin_date', 'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10',
                                'c11', 'c12', 'c13', 'c14', 'c15', 'c16', 'c17', 'c18', 'c19', 'c20', 'c21', 'c22', 'c23', 'c24', 'c25', 'c26', 'c27',
                                'c28', 'c29', 'c30', 'c31');
                            foreach ($row as $cell) {
                                if (in_array($cell, $h)) {
                                    $headers[] = $cell;
                                }
                            }
                        } else {
                            foreach ($headers as $i => $header) {
                                if ($header == "parent_id") {
                                    $model = gPerson::model()->findByPk($row[$i + 1]);
                                    if ($model != null) {
                                        $inside[$header] = $model->employee_name . " (" . $row[$i + 1] . ")";
                                    }
                                    else
                                        $inside[$header] = $row[$i + 1];
                                } elseif (substr($header, 0, 1) == "c") {
                                    $mod = gParamTimeblock::model()->findByPk($row[$i + 1]);
                                    if ($mod != null) {
                                        $inside[$header] = $row[$i + 1];
                                    }
                                    else
                                        $inside[$header] = "??";
                                } else {
                                    $inside[$header] = $row[$i + 1];
                                }
                            }
                            $all[] = $inside;
                        }
                    }
                }
            }

            $gridDataProvider = new CArrayDataProvider($all, array('pagination' => false));
            $this->render('timeblock', array(
                'headers' => $headers,
                'gridDataProvider' => $gridDataProvider,
            ));
        } else {
            if ($flash == "on")
                Yii::app()->user->setFlash('success', '<strong>Great!</strong> Migration Data from Excel to Schedule Tabel finished..');

            $this->render('timeblock', array());
        }
    }

    public function actionTimeblockSave() {

        Yii::import('ext.phpexcelreader.JPhpExcelReader');
        $file = Yii::app()->basePath . '/../sharedocs/temporarydocuments/schedule.xls';
        if (!is_file($file)) {
            $this->redirect('timeBlock');
        }

        $reader = new JPhpExcelReader($file);

        foreach ($reader->sheets as $k => $data)
            if ($k == 0) { {
                    foreach ($data['cells'] as $r => $row) {
                        if ($r == 1) {
                            $h = array('parent_id', 'begin_date', 'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10',
                                'c11', 'c12', 'c13', 'c14', 'c15', 'c16', 'c17', 'c18', 'c19', 'c20', 'c21', 'c22', 'c23', 'c24', 'c25', 'c26', 'c27',
                                'c28', 'c29', 'c30', 'c31');
                            foreach ($row as $cell) {
                                if (in_array($cell, $h)) {
                                    $headers[] = $cell;
                                }
                            }
                        } else {
                            $model = new gAttendanceTimeblock;
                            foreach ($headers as $i => $header) {
                                if (substr($header, 0, 1) == "c") {
                                    $mod = gParamTimeblock::model()->findByPk($row[$i + 1]);
                                    if ($mod != null) {
                                        $model->$header = $row[$i + 1];
                                    }
                                    else
                                        $model->$header = 91;
                                }
                                else
                                    $model->$header = $row[$i + 1];
                            }
                            if ($model->save(false))
                                continue;
                        }
                    }
                }
            }

        $this->deleteFile();
        $this->redirect(array('timeBlock', 'flash' => 'on'));
    }

    public function actionDeleteTempFile($flash = "off") {
        $this->deleteFile();
        $this->redirect(array('timeBlock'));
    }

    private function deleteFile() {
        $file = Yii::app()->basePath . '/../sharedocs/temporarydocuments/schedule.xls';
        if (is_file($file))
            unlink($file);
    }

    private function deleteFileAttendant() {
        $file = Yii::app()->basePath . '/../sharedocs/temporarydocuments/attendant.xls';
        if (is_file($file))
            unlink($file);
    }

    public function actionTimeblockUpload() {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $folder = 'sharedocs/temporarydocuments/';  // folder for uploaded files
        $allowedExtensions = array("xls");  //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 5 * 1024 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
        $fileName = $result['filename']; //GETTING FILE NAME

        echo $return; // it's array
    }

    public function actionAttendBlock() {

        $this->render('attendblock', array());
    }

    public function actionAttendblockUpload() {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $this->deleteFileAttendant();

        $folder = 'sharedocs/temporarydocuments/';  // folder for uploaded files
        $allowedExtensions = array("xls");  //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 5 * 1024 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
        $fileName = $result['filename']; //GETTING FILE NAME

        Yii::import('ext.phpexcelreader.JPhpExcelReader');
        $file = Yii::app()->basePath . '/../sharedocs/temporarydocuments/attendant.xls';
        if (!is_file($file)) {
            $this->redirect('attendBlock');
        }

        $reader = new JPhpExcelReader($file);

        foreach ($reader->sheets as $k => $data)
            if ($k == 0) { {
                    foreach ($data['cells'] as $r => $row) {
                        if ($r == 1) {
                            //do nothing
                        } else {
                            $model = array();
                            $criteria = new CDbCriteria;
                            if (isset($row[1])) {
                                $criteria->compare('parent_id', $row[1]);
                            }
                            else
                                $criteria->compare('parent_id', 'empty');

                            if (isset($row[2]))
                                $criteria->compare('cdate', date("Y-m-d", strtotime($row[2])));

                            $model = gAttendance::model()->find($criteria);

                            if ($model != null) {
                                if (isset($row[3]))
                                    $model->in = date("d-m-Y", strtotime($row[2])) . " " . $row[3];
                                if (isset($row[4]))
                                    $model->out = date("d-m-Y", strtotime($row[2])) . " " . $row[4];
                                $model->save(false);
                            }
                        }
                    }
                }
            }

        //$this->deleteFileAttendant();

        echo $return; // it's array
    }

    public function actionShow() {

        Yii::import('ext.phpexcelreader.JPhpExcelReader');
        $file = Yii::app()->basePath . '/../sharedocs/temporarydocuments/attendant.xls';
        if (!is_file($file)) {
            $this->redirect('attendBlock');
        }

        $reader = new JPhpExcelReader($file);

        foreach ($reader->sheets as $k => $data)
            if ($k == 0) { {
                    foreach ($data['cells'] as $r => $row) {
                        if ($r == 8) {
                            //echo date("Y-m-d",strtotime($row[2]))." ".$row[3];
                            echo print_r($row);
                        }
                    }
                }
            }
    }

    public function actionTransferAttendance($id, $month) {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $id);
        $criteria->compare('begin_date', date("Ym", strtotime(date("Y-m", strtotime($month . " month")) . "-01")));
        //$criteria->compare('begin_date','201211');

        $model = gAttendanceTimeblock::model()->find($criteria);

        if ($model != null) {
            $i = 1;
            while ($i <= 31) {
                $criteriaAttendance = new CDbCriteria;
                $criteriaAttendance->compare('parent_id', $id);
                $criteriaAttendance->compare('cdate', date("Y-m-", strtotime(date("Y-m", strtotime($month . " month")) . "-01")) . str_pad($i, 2, "0", STR_PAD_LEFT));
                $modelAttendance = gAttendance::model()->find($criteriaAttendance);

                if ($modelAttendance == null) {
                    $modelAttendanceNew = new gAttendance;
                    $modelAttendanceNew->parent_id = $id;
                    $modelAttendanceNew->cdate = str_pad($i, 2, "0", STR_PAD_LEFT) . date("-m-Y", strtotime(date("Y-m", strtotime($month . " month")) . "-01"));
                    $r = "c" . $i;
                    $modelAttendanceNew->realpattern_id = $model->$r;
                    $modelAttendanceNew->save();
                }
                $i++;
            }
        }


        $modelAttendance = $this->newAttendance($id, $month);

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'month' => $month,
            'modelAttendance' => $modelAttendance,
        ));
    }

    public function actionParamTimeblock() {
        $model = new gParamTimeblock;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamTimeblock'])) {
            $model->attributes = $_POST['gParamTimeblock'];
            $model->company_id = sUser::model()->getGroup();

            if ($model->save())
                $this->refresh();
        }

        $this->render('paramtimeblock', array(
            'model' => $model,
        ));
    }

    public function loadModelParamTimeblock($id) {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);

        if (Yii::app()->user->name != "admin") {
            $criteria->addInCondition('company_id', sUser::model()->getGroupArray());
        }
        $model = gParamTimeblock::model()->find($criteria);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionUpdateParamTimeblock($id) {
        $model = $this->loadModelParamTimeblock($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gParamTimeblock'])) {
            $model->attributes = $_POST['gParamTimeblock'];
            echo print_r($_POST['gParamTimeblock']);

            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formParamTimeblock', array('model' => $model));
    }

    public function actionDeleteParamTimeblock($id) {
        $this->loadModelParamTimeblock($id)->delete();
    }

    public function actionUpdateParamTimeblockAjax() {
        $model->attributes = $_POST;
        $model = $this->loadModelParamTimeblock($_POST['pk']);
        $model->$_POST['name'] = $_POST['value'];
        if ($model->save()) {
            return true;
        }
        else
            return false;
    }

}
