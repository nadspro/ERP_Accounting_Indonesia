<?php
/* @var $this GPayrollReportController */
/* @var $model gPayrollReport */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'g-payroll-report-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'parent_id'); ?>
        <?php echo $form->textField($model, 'parent_id'); ?>
        <?php echo $form->error($model, 'parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'yearmonth'); ?>
        <?php echo $form->textField($model, 'yearmonth'); ?>
        <?php echo $form->error($model, 'yearmonth'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'basic_salary'); ?>
        <?php echo $form->textField($model, 'basic_salary'); ?>
        <?php echo $form->error($model, 'basic_salary'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'benefit'); ?>
        <?php echo $form->textField($model, 'benefit'); ?>
        <?php echo $form->error($model, 'benefit'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'deduction'); ?>
        <?php echo $form->textField($model, 'deduction'); ?>
        <?php echo $form->error($model, 'deduction'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'remark'); ?>
        <?php echo $form->textField($model, 'remark', array('size' => 60, 'maxlength' => 300)); ?>
        <?php echo $form->error($model, 'remark'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'created_date'); ?>
        <?php echo $form->textField($model, 'created_date'); ?>
        <?php echo $form->error($model, 'created_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'created_by'); ?>
        <?php echo $form->textField($model, 'created_by'); ?>
        <?php echo $form->error($model, 'created_by'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'updated_date'); ?>
        <?php echo $form->textField($model, 'updated_date'); ?>
        <?php echo $form->error($model, 'updated_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'updated_by'); ?>
        <?php echo $form->textField($model, 'updated_by'); ?>
        <?php echo $form->error($model, 'updated_by'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->