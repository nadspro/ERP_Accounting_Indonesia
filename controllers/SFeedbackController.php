<?php

class SFeedbackController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'rights',
        );
    }

    public function actionView($id) {
        $comments = $this->newComment($id);

        if (isset($_POST['sFeedback']) && Yii::app()->user->name == 'admin')
            sFeedback::model()->updateByPk((int) $id, array('status_id' => $_POST['sFeedback']['status_id']));

        $model = $this->loadModel($id);


        $this->render('view', array(
            'model' => $model,
            'comments' => $comments,
        ));
    }

    protected function newComment($id) {
        $snotif = new sFeedbackDetail;

        if (isset($_POST['sFeedbackDetail'])) {
            $snotif->attributes = $_POST['sFeedbackDetail'];
            $snotif->parent_id = $id;
            $snotif->type_id = 1;
            $snotif->broadcast_code = 0;
            $snotif->receiver_date = time();
            $snotif->receiver_id = 1;
            $snotif->sender_ref = 'No Ref';
            $snotif->category_id = 1;
            $snotif->status_id = 1;
            $snotif->save();
            Yii::app()->user->setFlash('success', '<strong>Great!</strong> Comment has sent..');
            $this->refresh();
        }
        return $snotif;
    }

    public function actionCreate() {
        $model = new sFeedback;

        // $this->performAjaxValidation($model);

        if (isset($_POST['sFeedback'])) {
            $model->attributes = $_POST['sFeedback'];
            if (Yii::app()->user->name != 'admin') {
                /*
                  1 = Admin Message
                  2 = User Message
                  3 = Allocation Custom Message
                 */
                $model->type_id = 2;
                $model->status_id = 1;
            }
            if ($model->sender_ref == null)
            //$model->sender_ref=Yii::app()->user->name.' / '.sUser::model()->findByPk((int)$model->receiver_id)->username;
                $model->sender_ref = "FB-" . substr(str_shuffle(MD5(microtime())), 0, 7) . "-" . date('Y');

            if ($model->save()) {
                Yii::app()->user->setFlash('success', '<strong>Great!</strong> Your message has been sent successfully');
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModelSelf($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['sFeedback'])) {
            $model->attributes = $_POST['sFeedback'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', '<strong>Great!</strong> data has been saved successfully');
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        $this->redirect(array('admin'));
    }

    public function actionIndex() {

        $this->render('index', array(
                //'dataProvider'=>$dataProvider,
        ));
    }

    public function loadModel($id) {
        //if (Yii::app()->user->name == "admin") {
        $model = sFeedback::model()->findByPk((int) $id);
        //} else 
        //	$model=sFeedback::model()->findByPk((int)$id,'sender_id ='.Yii::app()->user->id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelSelf($id) {
        if (Yii::app()->user->name == "admin") {
            $model = sFeedback::model()->findByPk((int) $id);
        }
        else
            $model = sFeedback::model()->findByPk((int) $id, 'sender_id =' . Yii::app()->user->id);

        if ($model === null)
            throw new CHttpException(405, 'You are not authorized to update other users feedback.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sFeedback-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionMarkRead($id) {
        //$model=sFeedback::model()->findByPk((int)$id);
        $model = sFeedback::model()->findByPk((int) $id, array('condition' => 'receiver_id = ' . Yii::app()->user->id));

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $model->status_id = 4;
        $model->receiver_date = time();
        $model->save();

        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionMarkArchive($id) {
        $model = sFeedback::model()->findByPk((int) $id, array(
            'condition' => 'sender_id = :sender',
            'params' => array(':sender' => Yii::app()->user->id),
        ));

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $model->status_id = 6;
        $model->archive_date = time();
        $model->save();

        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionMarkHide($id) {
        $model = sFeedback::model()->findByPk((int) $id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $model->status_id = 6;
        $model->archive_date = time();
        $model->save();

        $this->redirect(array('admin'));
    }

}
