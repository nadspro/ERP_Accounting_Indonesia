<?php
/* @var $this GPersonEducationNfController */
/* @var $model GPersonEducationNf */
/* @var $form CActiveForm */
?>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker15', "
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


<div class="row">
    <div class="span9">

        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'gperson-education-nf-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ));
        ?>


        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'start_date', array('value' => date("d-m-Y"))); ?>

        <?php echo $form->textFieldRow($model, 'end_date', array()); ?>

        <?php echo $form->dropDownListRow($model, 'type_id', sParameter::items('cTraining')); ?>

        <?php echo $form->textFieldRow($model, 'topic', array('class' => 'span4')); ?>

        <?php echo $form->textFieldRow($model, 'instructor', array('class' => 'span3')); ?>

        <?php echo $form->textFieldRow($model, 'duration', array()); ?>

        <?php echo $form->dropDownListRow($model, 'sertificate', array('-1' => 'Yes', '0' => 'No')); ?>

        <?php echo $form->textFieldRow($model, 'organizer', array('class' => 'span3')); ?>

        <?php echo $form->textFieldRow($model, 'place', array()); ?>

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
</div><!-- form -->