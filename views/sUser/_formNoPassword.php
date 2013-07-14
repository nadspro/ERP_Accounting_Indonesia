<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('autocomp', "
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

<?php //echo $form->dropDownListRow($model,'default_group',aOrganization::model()->getRootList()); ?>
<?php echo $form->textFieldRow($model, 'default_group_name'); ?>
<?php echo $form->hiddenField($model, 'default_group'); ?>

<?php echo $form->dropDownListRow($model, 'status', sParameter::items("cStatus")); ?>

<div class="form-actions">
    <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create' : '<i class="icon-ok"></i> Save', array('class' => 'btn', 'type' => 'submit')); ?>
</div>


<?php $this->endWidget(); ?>
