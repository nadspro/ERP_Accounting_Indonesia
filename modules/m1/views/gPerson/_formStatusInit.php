<?php

Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
		$( \"#" . CHtml::activeId($model, 'end_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'start_date', array('value' => date("d-m-Y"))); ?>

<?php echo $form->textFieldRow($model, 'end_date'); ?>

<?php echo $form->dropDownListRow($model, 'status_id', sParameter::items('AK')); ?>

<?php

echo $form->textAreaRow($model, 'remark', array('class' => 'span4', 'rows' => 3));
