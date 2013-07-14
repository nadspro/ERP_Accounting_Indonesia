<?php
/* @var $this GPersonExperienceController */
/* @var $model gPersonExperience */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="span9">


        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'g-person-experience-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'company_name', array('class' => 'span4')); ?>

        <?php echo $form->textFieldRow($model, 'industries', array()); ?>

        <?php echo $form->textFieldRow($model, 'start_date', array()); ?>

        <?php echo $form->textFieldRow($model, 'end_date', array()); ?>

        <?php echo $form->textFieldRow($model, 'year_length', array('class' => 'span1')); ?>

        <?php echo $form->textFieldRow($model, 'month_length', array('class' => 'span1')); ?>

        <?php echo $form->textFieldRow($model, 'job_title', array('class' => 'span4')); ?>

        <?php echo $form->textAreaRow($model, 'job_description', array('class' => 'span5', 'rows' => 8)); ?>

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
