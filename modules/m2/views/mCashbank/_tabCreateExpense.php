<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');


Yii::app()->clientScript->registerScript('datepicker1', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
			
		'dateFormat' : 'dd-mm-yy',
		'changeMonth' : true,
        'changeYear' : true,
});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
});

		");
?>


<h2>
    <?php echo (isset($model->system_ref) ? "Update: " . $model->system_ref : "") ?>
</h2>

<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'u-journal-formOut',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'input_date'); ?>

<?php //echo $form->dropDownListRow($model,'yearmonth_periode',array(Yii::app()->settings->get("System", "cCurrentPeriod")=>Yii::app()->settings->get("System", "cCurrentPeriod"))); ?>

<?php echo $form->dropDownListRow($model, 'var_account', tAccount::cashBankAccount()); ?>
<?php echo $form->textFieldRow($model, 'cb_receiver', array('class' => 'span3')); ?>
<?php echo $form->textAreaRow($model, 'remark', array('class' => 'span5', 'rows' => 3)); ?>

<?php
$this->widget('ext.appendo.JAppendo', array(
    'id' => 'repeateEnum1',
    'model' => $model,
    'viewName' => '_detailJournalExpense',
    'labelDel' => 'Remove Row',
    'appendoPath' => '/modules/m2/views/jAppendo/',
        //'cssFile' => 'css/jquery.appendo2.css'
));
?>

<div class="form-actions">
    <?php echo CHtml::htmlButton('<i class="icon-ok"></i> Save Expense', array('class' => 'btn', 'type' => 'submit')); ?>
</div>

<?php $this->endWidget(); ?>
