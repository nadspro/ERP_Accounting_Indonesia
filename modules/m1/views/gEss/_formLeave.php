<?php
Yii::app()->getClientScript()
        ->registerCoreScript('jquery.ui')
        ->registerCoreScript('maskedinput')
        ->registerScriptFile(Yii::app()->baseUrl . "/css/bootstrap-maxlength/bootstrap-maxlength.js");


Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'work_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).mask('99-99-9999');
		$( \"#" . CHtml::activeId($model, 'work_date') . "\" ).mask('99-99-9999');
});

		$( \"textarea#" . CHtml::activeId($model, 'leave_reason') . "\" ).maxlength({
			alwaysShow: true
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

<?php echo $form->textFieldRow($model, 'input_date', array('class' => 'span2')); ?>

<?php echo $form->textFieldRow($model, 'start_date', array('class' => 'span2', 'hint' => 'Date when your leave started')); ?>

<?php echo $form->textFieldRow($model, 'end_date', array('class' => 'span2', 'hint' => 'Date when your leave ended')); ?>

<?php echo $form->textFieldRow($model, 'number_of_day', array('class' => 'span1', 'hint' => 'Total days of leaving')); ?>

<?php echo $form->textFieldRow($model, 'work_date', array('class' => 'span2', 'hint' => 'Date when you start work again')); ?>

<?php echo $form->textAreaRow($model, 'leave_reason', array('maxlength' => 300, 'class' => 'span4', 'rows' => 3)); ?>

<?php //echo $form->textFieldRow($model,'replacement',array('class'=>'span5','maxlength'=>10,'hint'=>'Your office mate as replacement during your leave')); ?>

<div class="control-group">
    <?php echo $form->labelEx($model, 'replacement', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'model' => $model,
            'attribute' => 'replacement',
            'source' => $this->createUrl('/m1/gEss/personAutoComplete'),
            'options' => array(
                'minLength' => '2',
            //'focus'=> 'js:function( event, ui ) {
            //	$("#'.CHtml::activeId($model,'c_ganti').'").val(ui.item.label);
            //	return false;
            //}',
            ),
            'htmlOptions' => array(
                'class' => 'input-medium',
                'placeholder' => 'Search Name',
                'class' => 'span4',
            ),
        ));
        ?>
    </div>
</div>



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
