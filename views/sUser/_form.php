<?php
Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'default_group_name') . "\" ).autocomplete({
		'minLength': '2',
		'source' : '" . Yii::app()->createUrl('/aOrganization/organizationAutoComplete') . "',
		'focus' : function( event, ui ) {
		$(\"#" . CHtml::activeId($model, 'default_group_name') . "\").val(ui.item.label);
		return false;
},
		'select' : function( event, ui ) {
		$(\"#" . CHtml::activeId($model, 'default_group') . "\").val(ui.item.id);
		return false;
},

});
});

		");

//Yii::app()->clientScript->registerScript('mask', "
//		$(function() {
//		$( \"#".CHtml::activeId($model,'username')."\" ).mask('aaaaaaaaaaaaaaa');
//		});
//");
?>

<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'user-module-form',
    //'type'=>'horizontal',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'full_name', array('class' => 'span4')); ?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span3')); ?>

<?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3')); ?>

<?php //echo $form->dropDownListRow($model,'default_group',aOrganization::model()->getRootList());  ?>
<?php echo $form->textFieldRow($model, 'default_group_name', array('class' => 'span4')); ?>
<?php echo $form->hiddenField($model, 'default_group'); ?>


<?php echo $form->dropDownListRow($model, 'status_id', sParameter::items("cStatus")); ?>

<div class="form-actions">
    <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create' : '<i class="icon-ok"></i> Save', array('class' => 'btn', 'type' => 'submit')); ?>
</div>

<?php $this->endWidget(); ?>
