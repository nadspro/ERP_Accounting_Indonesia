<?php

/**
 * This is the model class for table "sNotification".
 *
 * The followings are the available columns in table 'sNotification':
 * @property integer $id
 * @property string $title
 * @property string $expire
 * @property string $alert_after_date
 * @property string $alert_before_date
 * @property string $content
 * @property string $group_id
 * @property string $link
 */
class sNotificationMessage extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Notifyii the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 's_notification_message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('expire, content, link', 'required'),
			array('company_id, group_id, expire, alert_after_date, alert_before_date', 'numerical', 'integerOnly'=>true),
            array('content, title, alert_after_date, alert_before_date, group_id, link', 'safe'),
            array('id, expire, alert_after_date, alert_before_date, content, group_id, link, title', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'reads' => array(self::HAS_MANY, 'sNotificationMessageRead', 'notification_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'expire' => 'Expire',
            'alert_after_date' => 'Alert After Date',
            'alert_before_date' => 'Alert Before Date',
            'content' => 'Content',
            'group_id' => 'Role',
            'link' => 'Link',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('expire', $this->expire, true);
        $criteria->compare('alert_after_date', $this->alert_after_date, true);
        $criteria->compare('alert_before_date', $this->alert_before_date, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('group_id', $this->group_id, true);
        $criteria->compare('link', $this->link, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function getAllNotifications()
    {
        $criteria = new CDbCriteria;
		$criteria->addInCondition('group_id',sUser::model()->groupNotificationArray);
		$criteria->order='expire DESC';

        $notifiche = self::model()
                ->findAll($criteria);

        return $notifiche;
    }

    public static function getUnreadNotifications()
    {
		//$dependency = new CDbCacheDependency('SELECT count(company_id) FROM s_notification_message where company_id = '.sUser::model()->getGroup());

		//if (!Yii::app()->cache->get('unreadnotification'.Yii::app()->user->id)) {

			$criteria = new CDbCriteria;
			$criteria->addInCondition('group_id',sUser::model()->groupNotificationArray,'OR');
			$criteria->compare('company_id',sUser::model()->getGroup(),false,'OR');

			$criteria1 = new CDbCriteria;
			$criteria1->condition= "`t`.`id` NOT IN (
				SELECT `r`.`notification_id` FROM  `s_notification_message_read` `r` 
				WHERE `r`.`username` = ".Yii::app()->user->id." AND `r`.`notification_id` = `t`.`id`)";
			$criteria->mergeWith($criteria1);
			$criteria->order='expire DESC';

	        $notifiche = self::model()->findAll($criteria);

		//	Yii::app()->cache->set('unreadnotification'.Yii::app()->user->id,$notifiche,86400,$dependency);
		//} else
		//	$notifiche=Yii::app()->cache->get('unreadnotification'.Yii::app()->user->id);

        return $notifiche;
    }

    public static function getUnreadCount()
    {
        $criteria = new CDbCriteria;
		$criteria->addInCondition('group_id',sUser::model()->groupNotificationArray);
        $criteria->with=array('reads');
        $criteria->together=true;
        $criteria->condition='reads.username is null';
		$criteria->order='expire DESC';

        $notifiche = self::model()->count($criteria);

        return (int)$notifiche;
    }

    public static function getAllRoledNotifications($group_id = 'admin')
    {
        $criteria = new CDbCriteria(array(
                    'condition' => ':now >= t.alert_after_date AND :now <= t.alert_before_date AND t.group_id = :group_id',
                    'params' => array(
                        ':now' => date('Y-m-d'),
                        ':group_id' => $group_id,
                    )
                ));

        $notifiche = self::model()
                ->findAll($criteria);

        return $notifiche;
    }

    public function isNotReaded()
    {
        return !$this->isReaded();
    }

    public function isReaded()
    {
        $criteria=new CDbCriteria;
        $criteria->with=array('reads');
        $criteria->together=true;
        $criteria->compare('reads.username',Yii::app()->user->id);
        $model=self::model()->findByPk($this->id);
        
        if (isset($model)){
        	return true;
        } else
        	return false;
        
    }

    public function beforeSave()
    {
        if($this->alert_after_date === "") {
            $this->alert_after_date = $this->expire;
        }

        if($this->alert_before_date === "") {
            $this->alert_before_date = $this->expire;
        }

        return parent::beforeSave();
    }

/*    public function afterSave()
    {
        $adesso = new DateTime();

        $criteria = new CDbCriteria(array(
                    'condition' => 'alert_before_date < :date',
                    'params' => array(
                        ':date' => $adesso->format('Y-m-d'),
                    )
                ));

        $results = self::model()
                ->findAll($criteria);

        foreach ($results as $item) {
            $item->delete();
        }

        parent::afterSave();
    }
*/
}
