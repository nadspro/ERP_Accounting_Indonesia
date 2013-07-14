<?php
/* @var $this GPersonEducationNfController */
/* @var $model GPersonEducationNf */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'gperson-education-nf-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
    ));
    ?>


    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'education_name', array()); ?>

    <?php echo $form->textFieldRow($model, 'category', array()); ?>

    <?php echo $form->textFieldRow($model, 'start', array()); ?>

    <?php echo $form->textFieldRow($model, 'end', array()); ?>

    <?php echo $form->dropDownListRow($model, 'sertificate', array('-1' => 'Yes', '0' => 'No')); ?>

    <?php echo $form->textFieldRow($model, 'country', array()); ?>

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

</div><!-- form -->