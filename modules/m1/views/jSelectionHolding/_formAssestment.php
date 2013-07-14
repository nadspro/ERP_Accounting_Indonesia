<?php
$this->widget('TbGridView', array(
    'id' => 'j-selection-grid',
    'dataProvider' => hApplicantSelection::model()->search($id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        array(
            'name' => 'workflow_result.name',
            'header' => 'Work Flow Result'
        ),
        'workflow_by',
        'assestment_date',
        'assestment_summary',
        'development_area',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/jSelectionHolding/deleteAssestment",array("id"=>$data->id))',
        ),
    ),
));
?>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker111', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'assestment_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
			
});

		");
?>


<div class="row">
    <div class="span7">

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'g-education-form',
            'enableAjaxValidation' => false,
                //'type'=>'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'assestment_date', array()); ?>

        <?php echo $form->dropDownListRow($model, 'workflow_result_id', sParameter::items('cSelectionResult')); ?>

        <?php echo $form->textFieldRow($model, 'workflow_by', array('class' => 'span2')); ?>
        <?php echo $form->textAreaRow($model, 'assestment_summary', array('class' => 'span7', 'rows' => 5)); ?>

        <?php echo $form->textAreaRow($model, 'development_area', array('class' => 'span7', 'rows' => 5)); ?>

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
