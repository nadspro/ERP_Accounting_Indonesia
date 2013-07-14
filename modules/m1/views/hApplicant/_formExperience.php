<?php
/* @var $this GPersonExperienceController */
/* @var $model gPersonExperience */
/* @var $form CActiveForm */
?>

<div class="row-fluid">
    <div class="span12">


        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'g-person-experience-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'company_name', array()); ?>

        <?php echo $form->textFieldRow($model, 'industries', array()); ?>

        <?php echo $form->textFieldRow($model, 'start_date', array()); ?>

        <?php echo $form->textFieldRow($model, 'end_date', array()); ?>

        <?php echo $form->textFieldRow($model, 'year_length', array('class' => 'span1')); ?>

        <?php echo $form->textFieldRow($model, 'month_length', array('class' => 'span1')); ?>

        <?php echo $form->textFieldRow($model, 'job_title', array('width' => '30')); ?>

        <?php echo $form->textAreaRow($model, 'job_description', array('class' => 'span8', 'rows' => 10)); ?>

        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ));
            ?>
        </div>


        <?php $this->endWidget(); ?>

    </div>
</div>
<!-- form -->
