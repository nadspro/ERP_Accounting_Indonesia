<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker44', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'schedule_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
			
});

		");
?>

<?php
/* @var $this ILearningSchController */
/* @var $model iLearningSch */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'i-learning-sch-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'schedule_date', array('hint' => '*bugs: for temporary, format date will use English format mm/dd/yyyy')); ?>
<?php echo $form->textFieldRow($model, 'trainer_name', array('class' => 'span4')); ?>
<?php echo $form->textFieldRow($model, 'location', array('class' => 'span5')); ?>
<?php echo $form->textAreaRow($model, 'additional_info', array('class' => 'span4', 'rows' => 5)); ?>
<?php echo $form->dropDownListRow($model, 'status_id', sParameter::items("cTrainingStatus")); ?>
<?php echo $form->textFieldRow($model, 'cost', array('class' => 'span3')); ?>
<?php echo (!$model->isNewRecord) ? $form->textFieldRow($model, 'actual_mandays', array('class' => 'span1')) : ""; ?>
<?php echo ($model->isNewRecord) ? $form->textFieldRow($model, 'total_participant', array('class' => 'span1')) : ""; ?>


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

