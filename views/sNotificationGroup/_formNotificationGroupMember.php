<?php
/* @var $this SNotificationGroupMemberController */
/* @var $model sNotificationGroupMember */
/* @var $form CActiveForm */
?>

<div class="raw">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 's-notification-group-member-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
    ));
    ?>


    <?php echo $form->errorSummary($model); ?>

    <?php //echo $form->textFieldRow($model,'user_id');  ?>
    <?php echo $form->dropDownListRow($model, 'user_id', sUser::model()->allUsers()); ?>

    <?php echo $form->dropDownListRow($model, 'status_id', sParameter::items('cStatus')); ?>

    <div class="form-actions">
        <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Added' : '<i class="icon-ok"></i> Save', array('class' => 'btn', 'type' => 'submit')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->