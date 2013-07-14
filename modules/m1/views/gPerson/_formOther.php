<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'issued_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
		$( \"#" . CHtml::activeId($model, 'valid_to') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>


<?php
/* @var $this GPersonOtherController */
/* @var $model gPersonOther */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="span9">

        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'g-person-other-form',
            'enableAjaxValidation' => false,
                //'type'=>'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'category_name', array()); ?>
        <?php echo $form->textFieldRow($model, 'document_number', array('class' => 'span4')); ?>
        <?php echo $form->textFieldRow($model, 'issued_date', array()); ?>
        <?php echo $form->textFieldRow($model, 'valid_to', array()); ?>
        <?php echo $form->textAreaRow($model, 'custom_info1', array('rows' => 2, 'class' => 'span4')); ?>
        <?php //echo $form->textAreaRow($model,'custom_info2',array('rows'=>2,'class'=>'span4')); ?>
        <?php //echo $form->textAreaRow($model,'custom_info3',array('rows'=>2,'class'=>'span4'));  ?>
        <?php echo $form->textAreaRow($model, 'remark', array('rows' => 4, 'class' => 'span4')); ?>

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