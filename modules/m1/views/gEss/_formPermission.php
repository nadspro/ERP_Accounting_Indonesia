<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
		//$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).mask('99-99-9999 99:99');
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).mask('99-99-9999 99:99');
		$( \"#" . CHtml::activeId($model, 'number_of_day') . "\" ).mask('9?9');
		
		
});

		");
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'g-cuti-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'input_date'); ?>

<div class="control-group">
    <?php echo $form->labelEx($model, 'start_date', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'start_date',
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

<div class="control-group">
    <?php echo $form->labelEx($model, 'end_date', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'end_date',
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

<?php echo $form->dropDownListRow($model, 'permission_type_id', gParamPermission::model()->permissionDropDown(), array('class' => 'span7')); ?>

<?php echo $form->textFieldRow($model, 'number_of_day', array('class' => 'span1', 'hint' => 'Total days of permission')); ?>

<?php echo $form->textAreaRow($model, 'permission_reason', array('class' => 'span5', 'rows' => 4)); ?>



<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php
$this->endWidget();
