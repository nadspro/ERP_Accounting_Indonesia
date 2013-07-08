<?php

class HVacancyController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column3leftW';

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->layout = '//layouts/column2leftW';

        $modelCampaign = $this->newCampaign($id);

        $model = $this->loadModel($id);
        $this->render('view', array(
            'model' => $model,
            'modelCampaign' => $modelCampaign,
        ));
    }

    public function newCampaign($id) {
        $model = new hVacancyCampaign;

        if (isset($_POST['hVacancyCampaign'])) {
            $model->attributes = $_POST['hVacancyCampaign'];
            $model->parent_id = $id;

            if ($model->save())
                $this->redirect(array('view', 'id' => $id));
        }

        return $model;
    }

    public function actionUpdateCampaign($id) {
        $model = $this->loadModelCampaign($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hVacancyCampaign'])) {
            $model->attributes = $_POST['hVacancyCampaign'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formCampaign', array('model' => $model));
    }

    public function actionDeleteCampaign($id) {
        $this->loadModelCampaign($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function loadModelCampaign($id) {
        $model = hVacancyCampaign::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    function actionDetailApplicant($id) {

        $this->renderPartial('_detailApplicant', array(
            'modelApplicant' => $this->loadModelApplicant($id),
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $model = new hVacancy('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria->order = 'timestamp DESC';
        $criteria->order = 'created_date DESC';

        if (isset($_GET['hVacancy'])) {
            $model->attributes = $_GET['hVacancy'];

            $criteria1 = new CDbCriteria;
            $criteria1->compare('vacancy_title', $_GET['hVacancy']['vacancy_title'], true, 'OR');
            $criteria->mergeWith($criteria1);
        }

        if (Yii::app()->user->name != "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->condition = 'company_id IN (' . implode(",", sUser::model()->getGroupArray()) . ')';
            $criteria->mergeWith($criteria2);
        }

        $dataProvider = new CActiveDataProvider('hVacancy', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 25
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionEmail($id) {
        $model = new fInvitation;

        $modelVA = hVacancyApplicant::model()->findByPk((int) $id);

        if (isset($_POST['fInvitation'])) {
            $model->attributes = $_POST['fInvitation'];

            if ($model->validate()) {

                //mailprocess
                $headers = "From: " . Yii::app()->params['adminEmail'];
                $subject = "Interview Invitation : " . $modelVA->vacancy->vacancy_title . " at " . $modelVA->vacancy->company->name;

                $body = "Dear " . $modelVA->applicant->candidate_name . "," . "\r\n\r\n\r\n" .
                        "We are invite you for selection process (Interview) for " . $modelVA->vacancy->vacancy_title . " at " . $modelVA->vacancy->company->name . "will be held on:" . "\r\n\r\n\r\n" .
                        "Date : " . $model->datetime . "\r\n" .
                        "Time : " . $model->datetime . "\r\n\r\n" .
                        "Place :" . $model->place . "\r\n\r\n" .
                        "If there are any question welcome to contact us on this phone number 021-30046888. Please be on time." . "\r\n\r\n" .
                        "Thanks for your kind attention." . "\r\n\r\n" .
                        "Best Regards," . "\r\n" .
                        "Hardi" . "\r\n" .
                        "HRD APL Recruitment Team";


                mail($modelVA->applicant->registration->email, $subject, $body, $headers);
                //mail("peterjkambey@gmail.com",$subject,$body,$headers);

                Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You Registration has been successful. Please, open your 
				mailbox and click the link on that email to complete your registration process, or input the activation code below...');

                $modelVA->email_status_id = 2; //Sent
                $modelVA->save();

                $this->render('emailConfirm');
            }
        }

        $model->email = $modelVA->applicant->registration->email;

        $this->render('email', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionFilter($id) {
        $model = new hVacancy('search');
        $criteria = new CDbCriteria;
        $criteria->compare('jspecid', $id);
        $criteria->order = 'timestamp DESC';
        $dataProvider = new CActiveDataProvider('hVacancy', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 25
            ),
        ));

        if (Yii::app()->user->name != "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->condition = 'company_id IN (' . implode(",", sUser::model()->getGroupArray()) . ')';
            $criteria->mergeWith($criteria2);
        }

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionInterview($id = 0) {
        //$this->layout='//layouts/column2leftW';

        $model = new hVacancyApplicantComment;

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->together = true;
        $criteria->with = array('comment');
        $criteria->compare('t.status_id', 4);
        $criteria->order = 't.created_date DESC, comment.created_date DESC';

        if (isset($_POST['hVacancyApplicantComment'])) {
            $model->attributes = $_POST['hVacancyApplicantComment'];
            $model->parent_id = $id;
            $model->user_id = Yii::app()->user->id;
            $model->created_date = time();
            $model->save(false);
            $model->unsetAttributes();
        }

        $dataProvider = new CActiveDataProvider('hVacancyApplicant', array(
            'criteria' => $criteria,
                )
        );

        $this->render('interview', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionInterviewDetail($id = 0) {
        //$this->layout='//layouts/column2leftW';

        $model = new hVacancyApplicantComment;

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->together = true;
        $criteria->with = array('comment');
        $criteria->compare('t.status_id', 4);
        $criteria->compare('t.id', $id);
        $criteria->order = 'comment.created_date DESC';

        if (isset($_POST['hVacancyApplicantComment'])) {
            $model->attributes = $_POST['hVacancyApplicantComment'];
            $model->parent_id = $id;
            $model->user_id = Yii::app()->user->id;
            $model->created_date = time();
            $model->save(false);
            $model->unsetAttributes();
        }

        $dataProvider = new CActiveDataProvider('hVacancyApplicant', array(
            'criteria' => $criteria,
                )
        );

        $this->render('interview', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionDeleteDetail($id) {
        $this->loadModelDetail($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/applicant/status'));
    }

    public function actionProcess($id, $act) {
        $this->layout = '//layouts/column2leftW';

        $modelCampaign = $this->newCampaign($id);

        $model = $this->loadModelDetail($id);
        $model->status_id = $act;
        $model->save();

        $this->render('view', array(
            'model' => $this->loadModel($model->vacancy_id),
            'modelCampaign' => $modelCampaign,
        ));
    }

    public function actionStatus($id, $act) {
        hVacancy::model()->updateByPk($id, array('status_id' => $act));

        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $criteria = new CDbCriteria;
        $criteria->compare('id', (int) $id);

        if (Yii::app()->user->name != "admin") {
            $criteria->addInCondition('company_id', sUser::model()->getGroupArray());
        }

        $model = hVacancy::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelDetail($id) {
        $model = hVacancyApplicant::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelApplicant($id) {
        $model = hApplicant::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'g-vacancy-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->layout = '//layouts/column2leftW2';

        $model = new hVacancy;
        //$modelSch=new hVacancyCampaign;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        //if(isset($_POST['hVacancy'],$_POST['hVacancySch']))
        if (isset($_POST['hVacancy'])) {
            $model->attributes = $_POST['hVacancy'];
            //$modelSch->attributes=$_POST['hVacancySch'];
            $model->company_id = sUser::model()->getGroup();

            $valid = $model->validate();
            //$valid=$modelSch->validate() && $valid;

            if ($valid) {
                $model->save(false);
                //$modelSch->parent_id=$model->id;
                //$modelSch->save(false);

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
                //'modelSch'=>$modelSch,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['hVacancy'])) {
            $model->attributes = $_POST['hVacancy'];
            $model->company_id = sUser::model()->getGroup();
            $mode->timestamp = time();

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionToExcel($id, $tab) {

        if ($tab == 'prescreened') {
            $dataProvider = hVacancyApplicant::model()->search($id, 2);
        } elseif ($tab == 'interview')
            $dataProvider = hVacancyApplicant::model()->search($id, 4);

        $title = $dataProvider->getData();

        spl_autoload_unregister(array('YiiBase', 'autoload'));
        Yii::import('ext.phpexcel.Classes.PHPExcel', true);
        spl_autoload_register(array('YiiBase', 'autoload'));


        $phpExcel = new PHPExcel();

        $styleBold = array(
            'font' => array(
                'bold' => true,
            )
        );

        $styleBackground = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => 'D8D8D8',
                ),
            ),
            'font' => array(
                'name' => 'Arial',
                'size' => 12,
                'bold' => true,
            ),
        );

        $foo = $phpExcel->getActiveSheet();

        if ($tab == 'prescreened') {
            $foo->setTitle("Pre Screened");
        } elseif ($tab == 'interview')
            $foo->setTitle("Interview");

        $foo->setCellValue("A1", $title[0]->vacancy->vacancy_title)->getStyle("A1:H1")->applyFromArray($styleBackground);
        $foo->mergeCells("A1:H1");
        $foo->getStyle("A1:H1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $foo->getRowDimension(1)->setRowHeight(22);
        $foo->getRowDimension(2)->setRowHeight(20);
        $foo->getColumnDimension("A")->setWidth(5);
        $foo->getColumnDimension("B")->setWidth(15);
        $foo->getColumnDimension("C")->setWidth(30);
        $foo->getColumnDimension("D")->setWidth(40);
        $foo->getColumnDimension("E")->setWidth(20);
        $foo->getColumnDimension("F")->setWidth(30);
        $foo->getColumnDimension("G")->setWidth(10);
        $foo->getColumnDimension("H")->setWidth(30);

        $foo->setCellValue("A2", "No")
                ->setCellValue("B2", "Photo")
                ->setCellValue("C2", "Basic Profile")
                ->setCellValue("D2", "Education")
                ->setCellValue("E2", "Work Experience")
                ->setCellValue("G2", "Interview Progress")
                ->getStyle("A2:H2")->applyFromArray($styleBold)
        ;

        $counter = 3;
        $current = 1;

        foreach ($dataProvider->getData() as $data) {
            $n0 = $counter;
            $n1 = $counter + 1;
            $n2 = $counter + 2;
            $n3 = $counter + 3;
            $n4 = $counter + 4;
            $n5 = $counter + 5;
            $n6 = $counter + 6;

            //Basic Profile
            $foo
                    ->setCellValue("A$n0", $current)
                    ->setCellValue("B$n0", $data->applicant->applicant_name)
                    ->mergeCells("B$n0:C$n0")
            ;

            $foo->getRowDimension($n0)->setRowHeight(18);

            $foo
                    ->getStyle("A$n0:H$n0")
                    ->applyFromArray($styleBackground)
            ;

            $foo
                    ->setCellValue("B$n1", "PHOTO")
                    ->setCellValue("C$n1", "Birth Place: " . $data->applicant->birth_place)
                    ->setCellValue("C$n2", "Birth Date: " . $data->applicant->birth_date)
                    ->setCellValue("C$n3", "Gender: " . $data->applicant->sex->name)
                    ->setCellValue("C$n4", "Religion: " . $data->applicant->religion->name)
                    ->setCellValue("C$n5", "Handphone: " . $data->applicant->handphone)
                    ->setCellValue("C$n6", "Email: " . $data->applicant->email)
            ;

            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('test_img');
            $objDrawing->setDescription('test_img');
            $objDrawing->setPath($data->applicant->photoPathReal);
            $objDrawing->setHeight(130);
            $objDrawing->setCoordinates("B$n1");
            $objDrawing->setWorksheet($foo);

            //Education
            $line0 = 4;
            foreach ($data->applicant->many_education as $key => $dataEdu) {
                if ($dataEdu->level_id >= 8) {
                    $line1 = $line0 + 1;
                    $foo
                            ->setCellValue("D$line0", $dataEdu->edulevel->name . " " . $dataEdu->interest)
                            ->setCellValue("D$line1", $dataEdu->school_name . ", " . $dataEdu->graduate . ". GPA: " . $dataEdu->ipk)
                    ;

                    $line0 = $line1 + 1;
                }
            }

            //Experience
            foreach ($data->applicant->many_experience as $key => $dataExp) {
                $key = $key + 4;
                $foo
                        ->setCellValue("E$key", $dataExp->start_date . " - " . $dataExp->end_date)
                        ->setCellValue("F$key", $dataExp->job_title . " at " . $dataExp->company_name)
                ;
            }
            //Comment
            foreach ($data->comment as $key => $comment) {
                $key = $key + 4;
                $foo
                        ->setCellValue("G$key", $comment->user->username)
                        ->setCellValue("H$key", $comment->comment)
                ;
            }

            $counter = $n6 + 2;
            $current++;
        }

        $phpExcel->setActiveSheetIndex(0);

        //Output the generated excel file so that the user can save or open the file.
        header("Content-Type: application/vnd.ms-excel");
        if ($tab == 'prescreened') {
            header("Content-Disposition: attachment; filename=\"prescreened_" . date('Ymd') . ".xls\"");
        } elseif ($tab == 'interview')
            header("Content-Disposition: attachment; filename=\"interview_" . date('Ymd') . ".xls\"");

        header("Cache-Control: max-age=0");

        $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
        $objWriter->save("php://output");
        exit;
    }

    public function actionBroadcast($id) {
        $this->layout = '//layouts/column2leftW';

        $model = new fEmail;

        $modelVacancy = $this->loadModel((int) $id);

        $criteria = new CDbCriteria;
        $criteria->with = array('jobalert');
        $criteria->compare('jobalert.specialization_id', $modelVacancy->jspecid);
        $modelApplicant = hApplicant::model()->findAll($criteria);

        if ($modelApplicant != null) {
            foreach ($modelApplicant as $mApplicant) {
                $_list[] = $mApplicant->email;
            }
        }

        if (isset($_POST['fEmail'])) {
            $model->attributes = $_POST['fEmail'];
            if ($model->validate()) {
                foreach ($modelApplicant as $applicant) {
                    $model->body = str_replace('|applicant_name|', $applicant->applicant_name, $model->body);
                    EmailComponent::sendEmail($applicant->email, $model->subject, $model->body, 'ssl');
                }

                Yii::app()->user->setFlash('success', '<strong>Great!</strong> Your broadcast message has been sent to mail queue. 
				This application cannot guarantee all email will reach successfully to candidate mailbox, for mail server has it own mechanism to send and receive email...');

                $this->redirect(array('view', 'id' => $modelVacancy->id));
            }
        }

        if (isset($_list))
            $model->receiver = implode(", ", $_list);

        $model->subject = "Agung Podomoro Land. New Job Opening... Get it now!!!";
        $_level = (isset($modelVacancy->level)) ? $modelVacancy->level->name : '';
        $model->body = '<html><body>';
        $model->body .="
		<p>Dear, |applicant_name| </p>
		
		<p>We have just open a new job that we think might be applicable to you. Here the criteria: </p>
		
		Title: " . $modelVacancy->vacancy_title . "<br/>
		For Company: " . $modelVacancy->company_name . "<br/>
		Level: " . $_level . "<br/>
		Specialization: " . $modelVacancy->spec->name . "<br/>
		Work Address: " . $modelVacancy->work_address . "<br/>
		Work Area: " . $modelVacancy->work_area . "<br/>
		Min. Working Experience: " . $modelVacancy->min_work_exp . "<br/>
		Skill Required: " . $modelVacancy->skill_required . "<br/>
		<br/>
		
		<p>Click the link below, for more information and applying job. <br/>
		http://career.agungpodomoro-aphris.com/vacancy/" . $modelVacancy->id . " </p>
		
		<p>Thank You for your attention. </p>
		
		<br/>
		<br/>
		<p>Recruitment Administrator <br/>
		recruitment@agungpodomoro.com</p>";
        $model->body .= "</body></html>";

        $this->render('broadcast', array(
            'model' => $model,
            'modelVacancy' => $modelVacancy
        ));
    }

}
