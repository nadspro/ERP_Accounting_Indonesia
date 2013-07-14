<?php
/* @var $this GParamPermissionController */
/* @var $model gParamPermission */
/* @var $form CActiveForm */
?>

<div class="row">
    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'g-param-benefit-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'sort'); ?>
    <?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 100)); ?>


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