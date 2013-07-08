<?php

class MenuController extends Controller {

    public $layout = '//layouts/main';

    public function init() {
        //Yii::app()->language='id';
        //return parent::init();
        //Yii::import('ext.LanguagePicker.ELanguagePicker');
        //ELanguagePicker::setLanguage();
        //return parent::init();
    }

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    public function filters() {
        return array(
            'rights',
        );
    }

    public function actionIndex() {
        $dataProviderInbox = $this->listInbox();

        if (!Yii::app()->user->isGuest) {

            $this->render('index', array(
                'dataProviderInbox' => $dataProviderInbox,
            ));
        }
        else
            $this->redirect(array('site/login'));
    }

    public function listInbox($ajax = null) {
        Yii::app()->getModule('mailbox')->registerConfig($this->getAction()->getId());

        $dependency = new CDbCacheDependency('SELECT MAX(message_id) FROM s_mailbox_message');

        //if (!Yii::app()->cache->get('mailbb'.Yii::app()->user->id)) {

        $dataProvider = new CActiveDataProvider(Mailbox::model()->inbox(Yii::app()->user->id));

        //	Yii::app()->cache->set('mailbox1'.Yii::app()->user->id,$dataProvider,0,$dependency);
        //} else
        //	$dataProvider=Yii::app()->cache->get('mailbb'.Yii::app()->user->id);

        return $dataProvider;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newTask() {
        $model = new sTask;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['sTask'])) {
            $model->attributes = $_POST['sTask'];
            $model->created_by = Yii::app()->user->id;
            $model->mark_id = 1;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'data has been saved successfully');
                $this->refresh();
            }
        }

        return $model;
    }

    public function actionCalendarEvents() {
        $criteria = new CDbCriteria;
        $criteria->compare('category_id', 7);

        $models = sCompanyNews::model()->findAll($criteria);

        $items = array();
        $detail = array();
        $input = array("#CC0000", "#0000CC", "#333333", "#663333", "#993333", "#CC3333", "#003366", "#663366", "#993366", "#CC3366", "#6633CC");
        foreach ($models as $model) {
            $detail['title'] = $model->title;
            //$detail['start']= date('Y').'-'.date('m',strtotime($model->publish_date)).'-'.date('d',strtotime($model->publish_date));
            $detail['start'] = date('Y-m-d', strtotime($model->publish_date));
            $detail['color'] = $input[rand(0, 10)];
            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('sCompanyNews/view', array("id" => $model->id));
            $items[] = $detail;
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

}
