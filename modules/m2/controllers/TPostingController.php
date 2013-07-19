<?php

class TPostingController extends Controller {

    public $layout = '//layouts/column1';

    public function filters() {
        return array(
            'rights',
        );
    }

    public function actionUnlock($id) {
        uJournal::model()->updateByPk((int) $id, array('state_id' => 2, 'updated_date' => time(), 'updated_by' => Yii::app()->user->id));
    }

    public function actionRePosting() {  //backup Posting only
        $criteria = new CDbCriteria;
        $criteria->compare('state_id', 99);
        $criteria->compare('yearmonth_periode', Yii::app()->settings->get("System", "cCurrentPeriod"));
        $models = uJournal::model()->findAll($criteria);

        foreach ($models as $model) {
            set_time_limit(0);  //
            $this->actionPosting($model->id);
        }

        Yii::app()->user->setFlash('success', '<strong>Great!</strong> Reposting finished..');
        $this->redirect(array('/m1/default'));
    }

    public function actionPosting($id) {
        uJournal::model()->updateByPk((int) $id, array('state_id' => 4, 'updated_date' => time(), 'updated_by' => Yii::app()->user->id));
		return true;
    }

    public function actionUnposting($id) {
        $locked = uJournal::model()->updateByPk((int) $id, array('state_id' => 2, 'updated_date' => time(), 'updated_by' => Yii::app()->user->id));
		return true;
    }

    public function actionIndex($acc = null) {
        $model = new uJournal('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;
        $criteria->condition = 'state_id = 1 OR state_id = 2';

        if (isset($_GET['uJournal'])) {
            $model->attributes = $_GET['uJournal'];

            $criteria1->compare('system_ref', $_GET['uJournal']['system_ref'], true, 'OR');
            $criteria1->compare('remark', $_GET['uJournal']['system_ref'], true, 'OR');
        }

        if (isset($_GET['acc'])) {
            $criteria->with = array('journalDetail');
            $criteria->together=true;
            $criteria->compare('journalDetail.account_no_id', $_GET['acc']);
        }

        $criteria->compare('yearmonth_periode', Yii::app()->settings->get("System", "cCurrentPeriod"));

        $criteria->limit = 20;

        $criteria->mergeWith($criteria1);

        $dataProvider=new CActiveDataProvider('uJournal', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            )
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionIndexUnPost($acc = null) {
        $model = new uJournal('search');
        $model->unsetAttributes();  // clear any default values

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;
        $criteria->condition = 'state_id =4 or state_id = 3';
        $criteria->order = 't.updated_date DESC'; //last updated
        //$criteria->compare('journal_type_id',4);

        if (isset($_GET['uJournal'])) {
            $model->attributes = $_GET['uJournal'];

            $criteria1->compare('system_ref', $_GET['uJournal']['system_ref'], true, 'OR');
            $criteria1->compare('remark', $_GET['uJournal']['system_ref'], true, 'OR');
        }

        if (isset($_GET['acc'])) {
            $criteria->with = array('journalDetail');
            $criteria->together=true;
            $criteria->compare('journalDetail.account_no_id', $_GET['acc']);
        }

        $criteria->limit = 20;

        $criteria->mergeWith($criteria1);

        $dataProvider=new CActiveDataProvider('uJournal', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            )
        ));

        $this->render('indexUnpost', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);

        if ($model->state_id == 4) {
            Yii::app()->user->setFlash("error", "<strong>Error!</strong> Journal cannot be deleted. It has been posted...");
        }

        $model->delete();
    }

    public function loadModel($id) {
        $model = uJournal::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionPostingAutoComplete() {
        $res = array();
        if (isset($_GET['term'])) {
            $qtxt =
                    "SELECT system_ref FROM u_journal WHERE system_ref LIKE :name ORDER BY system_ref LIMIT 20";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
        }
        echo CJSON::encode($res);
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 't-account-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
