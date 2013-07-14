<?php
/* @var $this HVacancySchController */
/* @var $model hVacancySch */
/* @var $form CActiveForm */
?>

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

<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'h-vacancy-sch-form',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'campaign_name', array('class' => 'span5')); ?>
<?php echo $form->textFieldRow($model, 'start_date', array('value' => date("d-m-Y"))); ?>
<?php echo $form->textFieldRow($model, 'end_date'); ?>
<?php echo $form->textAreaRow($model, 'additional_info', array('rows' => 3, 'class' => 'span5')); ?>
<?php //echo $form->textFieldRow($model,'status_id');  ?>

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
