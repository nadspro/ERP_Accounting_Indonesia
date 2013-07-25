<?php

class cronCommand extends CConsoleCommand {

    public function actionIndex() {
        $connection = Yii::app()->db;
        $sqlRaw = "select * from g_person limit 10";
        $rawData = Yii::app()->db->createCommand($sqlRaw)->queryAll();
        $dataProvider = new CArrayDataProvider($rawData, array());

        foreach ($dataProvider->getData() as $data) {
            $sql = "insert into z_ar_log 
			(description, action, model, idModel, userid) VALUES 
			('" . $data['employee_name'] . "','INSERT','gLeave',1,1)";
            $command = $connection->createCommand($sql)->execute();
        }
    }

    public function actionDeleteUserRegistrationExpire() { //request more than 30 days
        $connection = Yii::app()->db;
        $sqlRaw = "DELETE FROM s_user_registration WHERE status_id = 1 AND registration_date < " . strtotime("-30 day");
        Yii::app()->db->createCommand($sqlRaw)->execute();

        $sqlRaw2 = "DELETE FROM `s_user_registration` WHERE id NOT IN (select id from h_applicant) AND registration_date < " . strtotime("-30 day");
        Yii::app()->db->createCommand($sqlRaw2)->execute();
    }

    public function actionUpdateVacancyApplicantExpire() { //request more than 30 days move to Reference
        $connection = Yii::app()->db;
        $sqlRaw = "UPDATE h_vacancy_applicant SET status_id = 3 where status_id = 1 AND created_date < " . strtotime("-30 day");
        Yii::app()->db->createCommand($sqlRaw)->execute();
    }

    public function actionDeleteNotificationOld() { //Notif more than 360 days or 6 months
        $connection = Yii::app()->db;
        $sqlRaw = "DELETE FROM s_notification WHERE alert_after_date < " . strtotime("-360 day");
        Yii::app()->db->createCommand($sqlRaw)->execute();
    }

}

?>
