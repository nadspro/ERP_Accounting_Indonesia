<?php
/* @var $this GPayrollReportController */
/* @var $model gPayrollReport */
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
        <?php echo $form->label($model, 'parent_id'); ?>
        <?php echo $form->textField($model, 'parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'yearmonth'); ?>
        <?php echo $form->textField($model, 'yearmonth'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'basic_salary'); ?>
        <?php echo $form->textField($model, 'basic_salary'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'benefit'); ?>
        <?php echo $form->textField($model, 'benefit'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'deduction'); ?>
        <?php echo $form->textField($model, 'deduction'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'remark'); ?>
        <?php echo $form->textField($model, 'remark', array('size' => 60, 'maxlength' => 300)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_date'); ?>
        <?php echo $form->textField($model, 'created_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_by'); ?>
        <?php echo $form->textField($model, 'created_by'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_date'); ?>
        <?php echo $form->textField($model, 'updated_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_by'); ?>
        <?php echo $form->textField($model, 'updated_by'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->