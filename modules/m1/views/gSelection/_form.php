<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
			$( \"#" . CHtml::activeId($model, 'birthdate') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
			'changeMonth' : true,
			'changeYear' : true,
			});
			$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
			});
			$( \"#" . CHtml::activeId($model, 'document_date') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
			});
			
		});

");
?>

<?php
/* @var $this GSelectionController */
/* @var $model gSelection */
/* @var $form CActiveForm */
?>

<div class="raw-fluid">
    <div class="span12">

        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'g-recruitment-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'input_date', array('value' => date("d-m-Y"))); ?>
        <?php echo $form->textFieldRow($model, 'code', array('class' => 'span2')); ?>
        <?php echo $form->textFieldRow($model, 'candidate_name', array('class' => 'span5')); ?>
<?php echo $form->textFieldRow($model, 'for_position', array('class' => 'span3')); ?>
            <?php echo $form->textAreaRow($model, 'job_description', array('class' => 'span6', 'rows' => 3)); ?>

        <div class="control-group">
                <?php echo $form->labelEx($model, 'company_id', array("class" => "control-label")); ?>
            <div class="controls">
                <?php
                echo $form->dropDownList($model, 'company_id', aOrganization::model()->companyDropDown(), array(
                    'empty' => 'Select Company:',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('/m1/gSelection/deptUpdate'),
                        'update' => '#' . CHtml::activeId($model, 'department_id'),
                    )
                        )
                );
                ?>
            </div>
        </div>

        <?php echo $form->dropDownListRow($model, 'department_id', array()); ?>

        <?php echo $form->dropDownListRow($model, 'level_id', gParamLevel::model()->levelDropDown()); ?>

        <?php echo $form->textAreaRow($model, 'address', array('class' => 'span6', 'rows' => 3)); ?>
        <?php echo $form->textFieldRow($model, 'address2', array('class' => 'span6')); ?>
        <?php echo $form->textFieldRow($model, 'address3', array('class' => 'span3')); ?>
        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5')); ?>
        <?php echo $form->textFieldRow($model, 'home_phone', array('class' => 'span3')); ?>
        <?php echo $form->textFieldRow($model, 'handphone', array('class' => 'span5')); ?>
        <?php echo $form->textFieldRow($model, 'birthdate'); ?>
        <?php echo $form->textAreaRow($model, 'quick_background', array('class' => 'span6', 'rows' => 5)); ?>
        <?php echo $form->textAreaRow($model, 'work_experience', array('class' => 'span6', 'rows' => 5)); ?>
        <?php echo $form->textFieldRow($model, 'sallary_expectation'); ?>
        <?php echo $form->dropDownListRow($model, 'source_id', sParameter::items('cSelectionSource')); ?>
        <?php echo $form->textAreaRow($model, 'operation_remark', array('class' => 'span6', 'rows' => 5)); ?>
        <?php echo $form->textFieldRow($model, 'document_date'); ?>
<?php echo $form->textAreaRow($model, 'document_remark', array('class' => 'span6', 'rows' => 5)); ?>

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
</div><!-- form -->