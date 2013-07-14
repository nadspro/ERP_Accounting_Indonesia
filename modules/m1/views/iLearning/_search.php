<?php
/* @var $this ILearningController */
/* @var $model iLearning */
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
        <?php echo $form->label($model, 'learning_title'); ?>
        <?php echo $form->textField($model, 'learning_title', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'objective'); ?>
        <?php echo $form->textField($model, 'objective', array('size' => 60, 'maxlength' => 1000)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'outline'); ?>
        <?php echo $form->textField($model, 'outline', array('size' => 60, 'maxlength' => 1000)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'participant'); ?>
        <?php echo $form->textField($model, 'participant', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'duration'); ?>
        <?php echo $form->textField($model, 'duration', array('size' => 3, 'maxlength' => 3)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'type_id'); ?>
        <?php echo $form->textField($model, 'type_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_date'); ?>
        <?php echo $form->textField($model, 'created_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_by'); ?>
        <?php echo $form->textField($model, 'created_by', array('size' => 15, 'maxlength' => 15)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_date'); ?>
        <?php echo $form->textField($model, 'updated_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_by'); ?>
        <?php echo $form->textField($model, 'updated_by', array('size' => 15, 'maxlength' => 15)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->