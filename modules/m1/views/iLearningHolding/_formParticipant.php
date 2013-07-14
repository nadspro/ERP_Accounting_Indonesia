<style>
    .userautocompletelink {height:52px;}
    .userautocompletelink img {float:left;margin-right:5px;width:40px;}

</style>


<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');


Yii::app()->clientScript->registerScript('autocom', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'employee_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/iLearningHolding/personAutoCompletePhoto') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'employee_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'employee_id') . "\").val(ui.item.id);
			return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'"
        . Yii::app()->baseUrl . "/shareimages/hr/employee/thumb/" . "'+item.photo+'\'/><strong>'+item.label+'</strong><br/>'+item.company+'</a>')
			.appendTo( ul );
		};
		

});

		");

Yii::app()->clientScript->registerScript('something', '$("#' . CHtml::activeId($model, 'employee_name') . '").focus();');
?>


<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'i-learning-sch-part-form',
    'enableAjaxValidation' => false,
    'type' => 'inline',
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'employee_name', array('class' => 'span4')); ?>
<?php echo $form->hiddenField($model, 'employee_id'); ?>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'primary',
    'label' => $model->isNewRecord ? 'Create' : 'Save',
));
?>


<?php
$this->endWidget();
