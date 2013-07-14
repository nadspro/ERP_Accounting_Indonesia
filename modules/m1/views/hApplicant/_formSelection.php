<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker1', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'workflow_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>

<?php
/* @var $this GSelectionProgressController */
/* @var $model gSelectionProgress */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'g-recruitment-invitation-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal'
        ));
?>


<?php echo $form->errorSummary($model); ?>

<div class="control-group">
    <?php echo $form->labelEx($model, 'workflow_id', array("class" => "control-label")); ?>
    <div class="controls">
        <?php
        echo $form->dropDownList($model, 'workflow_id', gParamSelection::levelDropdown(), array(
            'empty' => 'Select Process:',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/m1/hApplicant/workflowUpdate'),
                'update' => '#' . CHtml::activeId($model, 'workflow_result_id'),
            )
                )
        );
        ?>
    </div>
</div>

<?php echo $form->dropDownListRow($model, 'workflow_result_id', array()); ?>

<?php //echo $form->dropDownListRow($model,'workflow_id',sParameter::items('cSelectionProcess')); ?>
<?php echo $form->textFieldRow($model, 'assestment_date'); ?>
<?php echo $form->textFieldRow($model, 'workflow_by', array('class' => 'span3')); ?>
<?php //echo $form->dropDownListRow($model,'workflow_result_id',sParameter::items('cSelectionResult')); ?>
<?php echo $form->textAreaRow($model, 'assestment_summary', array('rows' => 4, 'class' => 'span4')); ?>
<?php echo $form->textAreaRow($model, 'development_area', array('rows' => 4, 'class' => 'span4')); ?>

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


