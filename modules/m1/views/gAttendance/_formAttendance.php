<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
$(function() {
		$( \"#" . CHtml::activeId($model, 'cdate') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		
		
});

		");
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'g-Attendance-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'cdate'); ?>
<?php echo $form->dropDownListRow($model, 'realpattern_id', gParamTimeblock::timeBlockDropDown()); ?>
<?php echo $form->dropDownListRow($model, 'daystatus1_id', gParamPermission::permissionDropDownPlus()); ?>
<?php echo $form->dropDownListRow($model, 'daystatus2_id', gParamPermission::permissionDropDownPlus()); ?>
<?php //echo $form->textFieldRow($model,'daystatus3_id'); ?>
<div class="control-group">
    <?php echo $form->labelEx($model, 'in', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'in',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
                'defaultValue' => (isset($model->cdate)) ? date('d-m-Y', strtotime($model->cdate)) : date('d-m-Y h:i'),
                'minDate' => ($model->cdate != null) ? date('d-m-Y', strtotime($model->cdate)) : date('d-m-Y', strtotime('01-' . date("m-Y"))),
                'maxDate' => ($model->cdate != null) ? date('d-m-Y', strtotime($model->cdate . "1 day")) :
                        date('d-m-Y', strtotime('01-' . date("m-Y", strtotime(date("d-m-Y") . "1 month")) . "-1 day")),
            ),
                )
        );
        ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'out', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'out',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
                'defaultValue' => (isset($model->cdate)) ? date('d-m-Y', strtotime($model->cdate)) : date('d-m-Y h:i'),
            //'minDate' => ($model->cdate !=null) ? date('d-m-Y',strtotime($model->cdate)) : date('d-m-Y',time()"-1 month"),
            //'maxDate' => ($model->cdate !=null) ? date('d-m-Y',strtotime($model->cdate."1 day")) : date('d-m-Y',time()"+1 month"),
            ),
                )
        );
        ?>
    </div>
</div>


<?php //echo $form->textFieldRow($model,'overtime_factor',array('size'=>3,'maxlength'=>3)); ?>
<?php echo $form->textFieldRow($model, 'remark', array('size' => 60, 'maxlength' => 150)); ?>

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


