<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-reorder"></i>
            <?php
            $unread = (sNotification::model()->unreadCount != 0) ? CHtml::tag("span", array('style' => 'font-size:inherit', 'class' => 'badge badge-info'), sNotification::model()->unreadCount) : "";
            echo " Notifications System " . $unread;
            ?></li>
    </ul>
</div>

<ul>
    <?php
    $notifiche = sNotification::getUnreadNotifications();

    foreach ($notifiche as $notifica) {
        echo CHtml::openTag('li', array());
        //echo $notifica->photo_path;
        echo CHtml::link($notifica->content, Yii::app()->createUrl('/sNotification/read', array('id' => $notifica->id)));
        echo CHtml::tag('i', array('style' => 'color:grey;font-size:11px; margin-bottom:10px;'), '  (' . waktu::nicetime($notifica->expire) . ')');
        echo CHtml::closeTag('li');
    }
    ?>
</ul>

<div class="pull-right">
    <p>
        <strong><?php echo CHtml::link('<i class="fam-add"></i> Notification Index', Yii::app()->createUrl('/sNotification')); ?></strong>				
    </p>
</div>

<br/>