<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */
/* @var $form CActiveForm */
?>

<div class="raw">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 's-notification-group-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'group_name', array('class' => 'span4')); ?>
    <?php echo $form->textAreaRow($model, 'group_description', array('class' => 'span4', 'rows' => 3)); ?>
    <?php echo $form->dropDownListRow($model, 'status_id', sParameter::items("cStatus")); ?>

    <div class="form-actions">
        <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create' : '<i class="icon-ok"></i> Save', array('class' => 'btn', 'type' => 'submit')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->