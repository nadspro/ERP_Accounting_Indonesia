<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */
/* @var $form CActiveForm */
?>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'iom_date') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
		});
                            
                });

		");
?>


<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'sNotification-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'iom_number', array('class' => 'span7', 'disabled' => true)); ?>

<?php echo $form->textFieldRow($model, 'iom_to', array('class' => 'span7')); ?>

<?php echo $form->textFieldRow($model, 'iom_cc', array('class' => 'span7')); ?>

<?php echo $form->textFieldRow($model, 'iom_from', array('class' => 'span7')); ?>

<?php echo $form->textFieldRow($model, 'subject', array('class' => 'span7')); ?>

<?php echo $form->textFieldRow($model, 'attachment', array('class' => 'span7')); ?>

<?php echo $form->textFieldRow($model, 'iom_date'); ?>

<?php
echo $form->html5EditorRow($model, 'content', array(
    'class' => 'span4', 'rows' => 5, 'height' => '300', 'options' => array('color' => true)));
?>

<?php echo $form->textFieldRow($model, 'sender_by', array('class' => 'span7')); ?>

<?php echo $form->textFieldRow($model, 'sender_title', array('class' => 'span7')); ?>

<?php echo $form->textFieldRow($model, 'approved_by', array('class' => 'span7')); ?>

<?php echo $form->textFieldRow($model, 'approved_title', array('class' => 'span7')); ?>



<div class="form-actions">
    <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create' : '<i class="icon-ok"></i> Save', array('class' => 'btn', 'type' => 'submit')); ?>
</div>


<?php $this->endWidget(); ?>
