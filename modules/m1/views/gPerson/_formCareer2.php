<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker12', "
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
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'g-karir2-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'start_date', array()); ?>

        <?php echo $form->textFieldRow($model, 'end_date', array()); ?>

        <?php echo $form->dropDownListRow($model, 'status_id', array('8' => 'Assignment')); ?>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'company_id', array("class" => "control-label")); ?>
            <div class="controls">
                <?php
                echo $form->dropDownList($model, 'company_id', aOrganization::model()->companyDropDown(), array(
                    'empty' => 'Select Company:',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('/m1/gPerson/deptUpdate2'),
                        'update' => '#' . CHtml::activeId($model, 'department_id'),
                    )
                        )
                );
                ?>
            </div>
        </div>

        <?php echo $form->dropDownListRow($model, 'department_id', array()); ?>

        <?php echo $form->dropDownListRow($model, 'level_id', gParamLevel::model()->levelDropDown()); ?>

        <?php echo $form->textFieldRow($model, 'job_title', array('class' => 'span4')); ?>

        <?php echo $form->textAreaRow($model, 'reason', array('class' => 'span4', 'rows' => 3)); ?>

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
