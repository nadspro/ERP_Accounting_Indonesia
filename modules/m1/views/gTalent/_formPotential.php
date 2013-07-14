<?php
/* @var $this GPersonPerformanceController */
/* @var $model gTalentPerformance */
/* @var $form CActiveForm */
?>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker5', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
			
});

		");
?>

<div class="row-fluid">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'g-person-performance-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'input_date'); ?>

    <?php echo $form->textFieldRow($model, 'year'); ?>

    <?php echo $form->textFieldRow($model, 'amount', array('class' => 'span2')); ?>

    <?php echo $form->hiddenField($model, 'qualification', array('value' => 0)); ?>

    <?php echo $form->textAreaRow($model, 'remark', array('rows' => 3, 'class' => 'span5')); ?>

    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ));
        ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->