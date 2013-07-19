<?php
/* @var $this TBalanceSheetController */
/* @var $model tBalanceSheet */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('TbActiveForm', array(
	'id'=>'t-balance-sheet-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model); ?>

		<?php //echo $form->textField($model,'budget',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->textFieldRow($model,'beginning_balance',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->textFieldRow($model,'debit',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->textFieldRow($model,'credit',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->textFieldRow($model,'end_balance',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->textAreaRow($model,'remark',array('rows'=>6, 'cols'=>50)); ?>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

