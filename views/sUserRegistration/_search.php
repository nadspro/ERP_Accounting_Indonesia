<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'module_name'); ?>
        <?php echo $form->textField($model, 'module_name', array('size' => 15, 'maxlength' => 15)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'registration_date'); ?>
        <?php echo $form->textField($model, 'registration_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'activation_code'); ?>
        <?php echo $form->textField($model, 'activation_code', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status_id'); ?>
        <?php echo $form->textField($model, 'status_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->