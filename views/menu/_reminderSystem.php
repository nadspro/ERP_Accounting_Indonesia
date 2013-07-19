<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-reorder"></i><?php echo Yii::t('basic', ' Reminder System') ?></li>
    </ul>
</div>

<ul>
    <?php
    $notifiche = sNotification::getReminder();

    foreach ($notifiche as $notifica) {
        echo CHtml::openTag('li', array());
        echo CHtml::link($notifica->mStatus() . ". " . strtoupper($notifica->employee_name) . " probation status is " . $notifica->countContract(), Yii::app()->createUrl('/m1/gPerson/view', array('id' => $notifica->id)));
        echo CHtml::closeTag('li');
    }
    ?>
</ul>


