<?php
/* @var $this JSelectionController */
/* @var $model jSelection */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'j-selection-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php //echo $form->textFieldRow($model,'pic',array('class'=>'span3'));  ?>
    <?php echo $form->dropDownListRow($model, 'category_id', sParameter::items('cSelectionType')); ?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'schedule_date', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $this->widget(
                    'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'schedule_date',
                'options' => array(
                    'dateFormat' => 'dd-mm-yy',
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                    'stepMinute' => 15,
                ),
                    )
            );
            ?>
        </div>
    </div>

    <?php echo $form->textAreaRow($model, 'additional_info', array('class' => 'span4', 'rows' => 3)); ?>
    <?php //echo $form->textFieldRow($model,'cost'); ?>
    <?php echo $form->dropDownListRow($model, 'status_id', sParameter::items("cTrainingStatus")); ?>

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