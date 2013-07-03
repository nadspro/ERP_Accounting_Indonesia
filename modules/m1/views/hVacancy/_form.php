<?php
/* @var $this HVacancyController */
/* @var $model hVacancy */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('optional', "
$('.optional-button').click(function(){
	$('.optional-form').toggle('slow');
	return false;
});
");
?>


<?php $this->widget('ext.tooltipster.tooltipster'); ?>

<div class="row">
<div class="span6">

<?php $form=$this->beginWidget('TbActiveForm', array(
	'id'=>'h-vacancy-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldRow($model,'vacancy_title',array('class'=>'span6')); ?>
		<?php //echo $form->textAreaRow($model,'vacancy_desc',array('class'=>'span6','rows'=>5)); ?>
		<?php //echo $form->textAreaRow($model,'skill_required',array('class'=>'span6','rows'=>5)); ?>

		<?php echo $form->html5EditorRow($model, 'vacancy_desc', array(
		'class'=>'span4', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true))); ?>

		<?php echo $form->html5EditorRow($model, 'skill_required', array(
		'class'=>'span4', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true))); ?>
		
		
		<?php //echo $form->textFieldRow($model,'industry_tag',array('class'=>'span4 tooltipster','title'=>'Please use coma to separate between tag')); ?>
		<?php echo $form->dropDownListRow($model,'industry_tag',sParameter::itemsWithName("cRecruitmentSpec")); ?>

		<?php //echo $form->textFieldRow($model,'for_level',array('class'=>'span4')); ?>
		<?php echo $form->dropDownListRow($model,'for_level',array(
			'Pelaksana'=>'Pelaksana',
			'Officer/Senior Officer'=>'Officer/Senior Officer',
			'Supervisor'=>'Supervisor',
			'Asst. Manager/Manager'=>'Asst. Manager/Manager',
			'General Manager'=>'General Manager',
			'Director'=>'Director',
		)); ?>

		<?php echo $form->textFieldRow($model,'city',array('class'=>'span3')); ?>
		<?php //echo $form->dropDownListRow($model,'sex_id',sParameter::itemsWithAll("cKelamin")); ?>

</div>
</div>

<div class="row">
<div class="span3">
		<?php //echo $form->dropDownListRow($model,'min_education_level',sParameter::items('EDU')); ?>
		<?php echo $form->dropDownListRow($model,'min_education_level',array(3=>'SMA',6=>'D3',8=>'S1',9=>'S2',10=>'S3')); ?>
</div>
<div class="span3">
		<?php echo $form->textFieldRow($model,'min_gpa',array('class'=>'span1')); ?>
</div>
</div>

<div class="row">
<div class="span6">
	<div class="input-append">
		<?php echo $form->textFieldRow($model,'min_working_exp',array('class'=>'span2')); ?><span class="add-on">Year</span>
	</div>
</div>
</div>

<?php echo CHtml::link('Show Optional Form','#',array('class'=>'optional-button')); ?>
<div class="optional-form" style="display:none">
	<div class="row">
	<div class="span6">
			<?php //echo $form->textFieldRow($model,'specification_tag',array('class'=>'span4 tooltipster','title'=>'Please use coma to separate between tag')); ?>
			<?php echo $form->textAreaRow($model,'work_address',array('class'=>'span6','rows'=>4)); ?>
			<?php //echo $form->textAreaRow($model,'promotion_content',array('rows'=>15, 'class'=>'span6')); ?>
	</div>
	</div>

	<div class="row">
	<div class="span2">
			<?php echo $form->textFieldRow($model,'min_salary',array('class'=>'span2')); ?>
	</div>
	<div class="span2">
			<?php echo $form->textFieldRow($model,'max_salary',array('class'=>'span2')); ?>
	</div>
	</div>

	<div class="row">
	<div class="span6">
			<?php echo $form->checkBoxRow($model,'salary_hide'); ?>
	</div>
	</div>
</div>


		<?php //echo $this->renderPartial('_formSch',array('model'=>$modelSch)); ?>
<div class="row">
<div class="span6">
 
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div><!-- form -->