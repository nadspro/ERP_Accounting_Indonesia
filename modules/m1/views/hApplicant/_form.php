<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'birth_date') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
			'changeMonth' : true,
			'changeYear' : true,
			'yearRange' : '" . date("Y", strtotime("-65 year")) . ":" . date("Y", strtotime("-15 year")) . "',
		});
		$( \"#" . CHtml::activeId($model, 'identity_valid') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>

<?php $this->widget('ext.tooltipster.tooltipster'); ?>

<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'g-person-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="span12">

        <?php //echo $form->textFieldRow($model,'applicant_code',array()); ?>

        <?php echo $form->textFieldRow($model, 'applicant_name', array('class' => 'span5')); ?>

        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span3')); ?>

        <?php echo $form->textFieldRow($model, 'birth_place', array('class' => 'span2')); ?>

        <?php echo $form->textFieldRow($model, 'birth_date', array('class' => 'tooltipster', 'title' => 'select from box or type-in directly using this format DD-MM-YYYY')); ?>

        <?php echo $form->textFieldRow($model, 'handphone', array()); ?>

        <?php echo $form->dropDownListRow($model, 'religion_id', sParameter::items("cAgama")); ?>

        <?php echo $form->dropDownListRow($model, 'sex_id', sParameter::items("cKelamin")); ?>

        <?php echo $form->textFieldRow($model, 'identity_number', array('class' => 'span4', 'hint' => 'KTP/SIM/Passport Number')); ?>

        <?php //echo $form->textFieldRow($model,'identity_valid',array('class'=>'tooltipster', 'title'=>'select from box or type-in directly using this format DD-MM-YYYY')); ?>

        <?php //echo $form->textFieldRow($model,'home_phone',array()); ?>

        <?php echo $form->textAreaRow($model, 'address1', array('class' => 'span5', 'rows' => 3)); ?>

        <?php echo $form->checkBoxRow($model, 'freshgrad_id', false, array('hint' => 'Check it, if you Fresh Graduation or less than 1 Year experience')); ?>

        <?php echo $form->textFieldRow($model, 'expected_sallary', array('class' => 'tooltipster', 'title' => 'expected salary (in Rupiah)')); ?>

        <?php echo $form->textFieldRow($model, 'expected_position', array('class' => 'span5')); ?>

        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ));
            ?>

        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

