<?php
/* @var $this ILearningController */
/* @var $model iLearning */
/* @var $form CActiveForm */
?>

<div class="page-header">
	<h1>
		<i class="icon-fa-book"></i>
		Feedback: <?php echo $modelSch->employee->employee_name; ?>
	</h1>
<p>
<h3>On: <?php echo $modelSch->getparent->getparent->learning_title. " :: ".$modelSch->getparent->schedule_date ?> <h3>
</p>
</div>


<?php $form=$this->beginWidget('TbActiveForm', array(
	'id'=>'i-learning-feedback',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

<div class="row">
<div class="span3">
		<?php echo $form->textFieldRow($model,'A1',array('class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'A2',array('class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'A3',array('class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'A4',array('class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'A5',array('class'=>'span1')); ?>
</div>
<div class="span3">
		<?php echo $form->textFieldRow($model,'B1',array('class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'B2',array('class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'B3',array('class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'B4',array('class'=>'span1')); ?>
</div>
<div class="span3">
		<?php echo $form->textFieldRow($model,'C1',array('class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'C2',array('class'=>'span1')); ?>
</div>
</div>

<div class="row">
<div class="span9">
		<?php echo $form->textAreaRow($model,'D1',array('class'=>'span6','rows'=>3)); ?>
		<?php echo $form->textAreaRow($model,'D2',array('class'=>'span6','rows'=>3)); ?>
</div>
</div>



		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
			)); ?>

		</div>

<?php $this->endWidget(); 