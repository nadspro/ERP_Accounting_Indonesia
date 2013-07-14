<?php

class SNotificationController extends Controller {

    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights',
            //'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function actionRead($id, $add = true) {
        $criteria = new CDbCriteria;
        $criteria->compare('id', (int) $id);

        if (!Yii::app()->user->name == "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->addInCondition('group_id', sUser::model()->groupNotificationArray, 'OR');
            $criteria2->compare('company_id', sUser::model()->getGroup(), false, 'OR');
            $criteria->mergeWith($criteria2);

            $criteria1 = new CDbCriteria;
            $criteria1->condition = "`t`.`id` NOT IN (
							SELECT `r`.`notification_id` FROM  `s_notification_read` `r` 
							WHERE `r`.`username` = " . Yii::app()->user->id . " AND `r`.`notification_id` = `t`.`id`)";
            $criteria->mergeWith($criteria1);
        }

        $criteria->order = 'expire DESC';

        $model = sNotification::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        if ($add) {
            $reads = new sNotificationRead();
            $reads->username = Yii::app()->user->id;
            $reads->notification_id = $id;
            $reads->readed = true;

            $reads->save(false);
        }

        $this->redirect(Yii::app()->createUrl($model->link));
    }

    public function actionMarkRead() {

        $criteria = new CDbCriteria;
        $criteria->addInCondition('group_id', sUser::model()->groupNotificationArray, 'OR');
        $criteria->compare('company_id', sUser::model()->getGroup(), false, 'OR');

        $criteria1 = new CDbCriteria;
        $criteria1->condition = "`t`.`id` NOT IN (
			SELECT `r`.`notification_id` FROM  `s_notification_read` `r` 
			WHERE `r`.`username` = " . Yii::app()->user->id . " AND `r`.`notification_id` = `t`.`id`)";
        $criteria->mergeWith($criteria1);
        $criteria->order = 'expire DESC';

        $models = sNotificationMessage::model()->findAll($criteria);
        if ($models === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        foreach ($models as $model) {
            $reads = new sNotificationMessageRead();
            $reads->username = Yii::app()->user->id;
            $reads->notification_id = $model->id;
            $reads->readed = true;

            $reads->save(false);
        }

        $this->redirect(array('/sNotification'));
    }

    public function actionIndex() {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('group_id', sUser::model()->groupNotificationArray, 'OR');
        $criteria->compare('company_id', sUser::model()->getGroup(), false, 'OR');

        $criteria->order = 'expire DESC';


        $dataProvider = new CActiveDataProvider('sNotification', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            )
        ));


        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->addInCondition('group_id', sUser::model()->groupNotificationArray);
        $model = sNotification::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
