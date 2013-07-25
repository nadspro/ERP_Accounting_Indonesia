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

    public function create($group, $url, $message, $company = null,$photopath = null) {
        $model = new sNotification();
        $model->expire = time();
        $model->alert_after_date = time();
        $model->alert_before_date = date(strtotime("1 month"));

        $model->group_id = $group;
        $model->link = $url;
        $model->content = $message;
        if ($company ==null && !Yii::app()->user->isGuest) {
	        $model->company_id = sUser::model()->getGroup();
	    } else
	        $model->company_id = $company;
		
    	$model->photo_path = $photopath;
	

        if ($model->save(false)) {
            return true;
        }
        else
            return false;
    }
    
	public function newInbox($recipient,$subject,$message) {
	
	    	$conv = new Mailbox(); //s_mailbox_conversation
            $conv->subject = $subject;
            $conv->initiator_id = 1;

			$conv->interlocutor_id = $recipient;

            $conv->modified = time();
            $conv->bm_read = 0;

            $msg = new Message; //s_mailbox_message
            $msg->text = $message;
            
            $msg->created = time();
            $msg->sender_id = 1;
            $msg->recipient_id = $recipient;
			
			$msg->crc64 = 0;

			$conv->save(false);
			$msg->conversation_id = $conv->conversation_id;
			$msg->save(false);
			
			return true;
	
	}
    

}

?>
