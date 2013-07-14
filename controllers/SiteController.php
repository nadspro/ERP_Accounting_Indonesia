<?php

class SiteController extends Controller {

    public $layout = '//layouts/column1';

    public function init() {
        //Yii::app()->language='id';
        return parent::init();

        //Yii::import('ext.LanguagePicker.ELanguagePicker');
        //ELanguagePicker::setLanguage();
        //return parent::init();
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'link' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        //$this->layout='//layouts/mainGuest';
        $this->layout = '//layouts/column1';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionNotSupportedBrowser() {
        $b = new EWebBrowser;

        if ($b->browser != 'Internet Explorer')
            $this->redirect(array('/menu'));

        $this->layout = '//layouts/baseNotSupport';
        $this->render('notSupportedBrowser');
    }

    public function actionLogin() {
        $this->redirect(array('/site'));
    }

    /**
     * Displays the login page
     */
    public function actionIndex() {

        $b = new EWebBrowser;

        if ($b->browser == 'Internet Explorer')
            $this->redirect(array('notSupportedBrowser'));


        $model = new fLogin;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['fLogin'])) {
            $model->attributes = $_POST['fLogin'];
            if ($model->validate() && $model->login()) {

                sUser::model()->updateByPk((int) Yii::app()->user->id, array('last_login' => time()));

                $this->redirect(Yii::app()->user->returnUrl);
            }
        }


        if (Yii::app()->user->isGuest) {
            //Yii::app()->user->setFlash('info','<strong>MAINTENANCE DOMAIN!!</strong>
            //Jika alamat URL di browser adalah: http://202.158.114.128 . JANGAN PANIK!!! Untuk sementara waktu URL www.agungpodomoro-aphris.com belum bisa digunakan 
            //karena masih dalam tahap progasi domain yang berlansung selama kurang lebih 24 jam. Besok (2 Juli 2013), mestinya domain sudah bisa berfungsi normal kembali');

            $this->render('login', array('model' => $model));
        } else {
            $this->redirect(array('/menu'));
        }
    }

    public function actionLogin2() {

        $model = new fLogin;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['fLogin'])) {
            $model->attributes = $_POST['fLogin'];
            if ($model->validate() && $model->login()) {

                sUser::model()->updateByPk((int) Yii::app()->user->id, array('last_login' => time()));

                $this->redirect(Yii::app()->user->returnUrl);
            }
        }


        if (Yii::app()->user->isGuest) {
            $this->render('login2', array('model' => $model));
        } else {
            $this->redirect(array('/menu'));
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        //$this->redirect(Yii::app()->homeUrl);
        $this->redirect(array('/site/login'));
    }

    public function actionPhoto() {
        //$this->layout='//layouts/column1breadcrumb';

        $this->render('/site/photo');
    }

    public function actionPhotoAlbum($id) {
        //$this->layout='//layouts/column1breadcrumb';

        $this->render('/site/photoAlbum', array(
            "id" => $id,
        ));
    }

    public function actionLearning() {
        //$this->layout='//layouts/column2';
        $this->render('/site/learning');
    }

    public function actionCalendarEvents() {
        $criteria = new CDbCriteria;
        $criteria->with = array('getparent');
        $criteria->compare('year(schedule_date)', date("Y"));
        $criteria->together = true;
        $criteria->AddInCondition('getparent.type_id', array(1, 2));

        $models = iLearningSch::model()->findAll($criteria);

        $items = array();
        $detail = array();
        $input = array("#CC0000", "#0000CC", "#333333", "#663333", "#993333", "#CC3333", "#003366", "#663366", "#993366", "#CC3366", "#6633CC");
        foreach ($models as $model) {
            $detail['title'] = $model->learning_status;
            $detail['start'] = date('Y') . '-' . date('m', strtotime($model->schedule_date)) . '-' . date('d', strtotime($model->schedule_date));
            //$detail['start']= $model->schedule_date;
            $detail['color'] = $input[rand(0, 10)];
            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('site/viewDetail', array("id" => $model->id));
            $items[] = $detail;
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionViewDetail($id) {
        $this->render('viewDetail', array(
            'model' => $this->loadModelSchedule($id),
        ));
    }

    public function loadModelSchedule($id) {
        $model = iLearningSch::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionRegister() {
        $model = new sUser;
        $model->setScenario('registration');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['sUser'])) {
            $model->attributes = $_POST['sUser'];

            $criteria = new CDbCriteria;
            $criteria->condition = 'activation_code = :code AND activation_expire >=' . time();
            $criteria->params = array(':code' => $_POST['sUser']['activation_code']);
            $cekValidationCode = gPerson::model()->find($criteria);

            if ($cekValidationCode != null)
                $model->default_group = $cekValidationCode->mCompanyId();

            $model->status_id = 1;

            if ($model->validate()) {

                $model->created_date = time();
                $model->created_by = 1;
                $_mysalt = sUser::blowfishSalt();
                //$model->password = crypt($model->password, $_mysalt);

                $model->save(false);

                //sUser::model()->updateByPk((int) $model->id, array('password' => $_password, 'salt' => $_mysalt, 'hash_type' => 'crypt'));

                $connection = Yii::app()->db;

                $sql1 = "INSERT INTO `s_authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
				('Authenticated', " . $model->id . ", NULL, 'N;'),
				('HR ESS Staff', " . $model->id . ", NULL, 'N;');";

                $sql2 = "INSERT INTO `s_user_module` (`s_user_id`, `s_module_id`, `s_matrix_id`, `favourite_id`) VALUES
				(" . $model->id . ", 23, 5, 1),
				(" . $model->id . ", 24, 5, 1),
				(" . $model->id . ", 25, 5, 1),
				(" . $model->id . ", 26, 5, 1),
				(" . $model->id . ", 67, 5, 1),
				(" . $model->id . ", 208, 5, 1);";

                $command1 = $connection->createCommand($sql1);
                $command1->execute();

                $command2 = $connection->createCommand($sql2);
                $command2->execute();

                $cekValidationCode->userid = $model->id;
                $cekValidationCode->save(false);


                Yii::app()->user->setFlash('success', '<strong>Your Registration process is succesfull. Please, login with your given username and password');
                $this->redirect(array('site/login2'));
            }
        }

        Yii::app()->user->setFlash('info', '<strong>IMPORTANT INFO!!</strong>
		This Page is dedicated FOR internal Employee !!!... 
		before you activate your username and password, 
			step #1, ask your ACTIVATION CODE to HR Manager at your business unit. Otherwise, you can\'t continue to register.');

        $this->render('register', array(
            'model' => $model,
        ));
    }

    // Facebook log in
    /* public function actionFacebooklogin() {
      Yii::import('ext.facebook.*');
      $ui = new FacebookUserIdentity('74026521543', '7f2ffd4bcdfafd919e276006223b4fd4');
      if ($ui->authenticate()) {
      $user=Yii::app()->user;
      $user->login($ui);
      $this->redirect($user->returnUrl);
      } else {
      throw new CHttpException(401, $ui->error);
      }
      } */
}