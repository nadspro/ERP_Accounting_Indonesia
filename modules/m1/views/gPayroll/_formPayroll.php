<?php
/* @var $this GPayrollController */
/* @var $model gPayroll */
/* @var $form CActiveForm */
?>

<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>
<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('monthpicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'yearmonth_start') . "\" ).datepicker({

		'changeMonth': true,
        'changeYear': true,
        'showButtonPanel': true,
        'dateFormat': 'yymm',
        'onClose': function(dateText, inst) { 
            var month = $(\"#ui-datepicker-div .ui-datepicker-month :selected\").val();
            var year = $(\"#ui-datepicker-div .ui-datepicker-year :selected\").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }


		});
				
});

		");
?>

<div class="row">
    <div class="span9">

        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'g-payroll-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'yearmonth_start'); ?>
        <?php echo $form->dropDownListRow($model, 'category_id', gParamPayroll::model()->payrollDropDown()); ?>
        <?php echo $form->textFieldRow($model, 'basic_salary'); ?>
        <?php echo $form->textAreaRow($model, 'remark', array('class' => 'span4', 'rows' => 3)); ?>

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

    </div>
</div>