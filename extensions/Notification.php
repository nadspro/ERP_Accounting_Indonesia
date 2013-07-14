<?php

/*
 *
 * Class : Notification
 * class untuk mengcreate Notification per User Group
 *
 * author: Peter J. Kambey
 * 26 November 2012
 * gratis
 *
 * contoh:
 * echo Notification::create($recepient int,$url string, $message string);
 * 
 * 
 */

Class Notification {

    public function create($group, $url, $message) {
        $model = new sNotification();
        $model->expire = time();
        $model->alert_after_date = time();
        $model->alert_before_date = date(strtotime("1 month"));

        $model->group_id = $group;
        $model->link = $url;
        $model->content = $message;
        $model->company_id = sUser::model()->getGroup();

        if ($model->save(false)) {
            return true;
        }
        else
            return false;
    }

}

?>
