<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');


Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#" . CHtml::activeId($model, 'item_name') . "\" ).autocomplete({
		'minLength': '2',
		'source' : '" . Yii::app()->createUrl('/m2/xProduct/xProductAutoComplete') . "',
		'focus' : function( event, ui ) {
		$(\"#" . CHtml::activeId($model, 'item_name') . "\").val(ui.item.label);
		return false;
},
		'select' : function( event, ui ) {
		$(\"#" . CHtml::activeId($model, 'item_id') . "\").val(ui.item.id);
		return false;
},

});
		$( \"#" . CHtml::activeId($model, 'input_date') . "\" ).mask('99-99-9999');
});

		");
?>



<div class="row-fluid">
    <div class="span12">
        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'b-porder-detail-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'input_date'); ?>

        <?php echo $form->dropDownListRow($model, 'customer_id', uCustomer::items()); ?>

        <?php echo $form->textAreaRow($model, 'remark', array('rows' => 2, 'class' => 'span5')); ?>


        <div id="xForm">
            <?php echo $this->renderPartial('_formDetail', array('model' => $model, 'dataProvider' => $dataProvider)); ?>
        </div>

        <?php echo CHtml::activeTextField($model, 'item_name', array('class' => 'span3')); ?>
        <?php echo $form->hiddenField($model, 'item_id', array('class' => 'span3')); ?>

        <?php
        //echo $form->textFieldRow($model,'description',array('size'=>60,'maxlength'=>500));
        echo CHtml::ActiveTextField($model, 'description', array('size' => 60, 'maxlength' => 500));
        ?>

        <?php
        //echo $form->textFieldRow($model,'qty');
        echo CHtml::activeTextField($model, 'qty');
        ?>

        <?php
        //echo $form->textFieldRow($model,'amount',array('size'=>15,'maxlength'=>15));
        echo CHtml::activeTextField($model, 'amount', array('size' => 15, 'maxlength' => 15));
        ?>

        <div class="form-actions">
            <?php
            if (!isset($model->id)) { //new
                echo CHtml::ajaxSubmitButton('Add Row', Yii::app()->createUrl($this->route), array('update' => '#xForm'));
            }
            else //update
                echo CHtml::ajaxSubmitButton('Add Row', Yii::app()->createUrl($this->route, array("id" => $model->id)), array('update' => '#xForm'));
            ?>
            <?php echo CHtml::SubmitButton('Create'); ?>
            <?php echo CHtml::link('Close', array('/m2/vSorderInventory/deleteTemp'), array('class' => 'btn')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
<!-- form -->
