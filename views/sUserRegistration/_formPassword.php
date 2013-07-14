<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */
/* @var $form CActiveForm */
?>

<div class="raw">
    <div class="span12">

        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 's-user-registration-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->passwordFieldRow($model, 'password', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->passwordFieldRow($model, 'password_repeat', array('size' => 60, 'maxlength' => 255)); ?>

        <div class="form-actions">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div><!-- form -->