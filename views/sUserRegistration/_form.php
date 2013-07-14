<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */
/* @var $form CActiveForm */
?>

<div class="raw">
    <div class="class12">

        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 's-user-registration-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->dropDownListRow($model, 'module_name', array('Recruitment' => 'Recruitment')); ?>
        <?php //echo $form->textFieldRow($model,'registration_date'); ?>
        <?php //echo $form->textFieldRow($model,'activation_code',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->textFieldRow($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>
        <?php //echo $form->passwordFieldRow($model,'password',array('size'=>60,'maxlength'=>255));  ?>
        <?php echo $form->dropDownListRow($model, 'status_id', sParameter::items('cStatusP')); ?>

        <div class="form-actions">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div><!-- form -->