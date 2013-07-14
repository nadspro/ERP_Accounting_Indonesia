<style>
    .userautocompletelink {height:52px;}
    .userautocompletelink img {float:left;margin-right:5px;width:40px;}

</style>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'applicant_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/jSelection/personAutoCompletePhoto') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'applicant_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'applicant_id') . "\").val(ui.item.id);
			return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'"
        . Yii::app()->baseUrl . "/shareimages/hr/applicant/" . "'+item.photo+'\'/><strong>'+item.label+'</strong><br/>'+item.detail+'</a>')
			.appendTo( ul );
		};
		

});

		");
?>


<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'i-learning-sch-part-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'applicant_name', array('class' => 'span4')); ?>
<?php echo $form->hiddenField($model, 'applicant_id'); ?>

<div class="control-group">
    <?php echo $form->labelEx($model, 'company_id', array("class" => "control-label")); ?>
    <div class="controls">
        <?php
        echo $form->dropDownList($model, 'company_id', aOrganization::model()->companyDropDown(), array(
            'empty' => 'Select Company:',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/m1/jSelection/deptUpdate'),
                'update' => '#' . CHtml::activeId($model, 'department_id'),
            )
                )
        );
        ?>
    </div>
</div>

<?php echo $form->dropDownListRow($model, 'department_id', array()); ?>

<?php echo $form->dropDownListRow($model, 'level_id', gParamLevel::model()->levelDropDown()); ?>

<?php echo $form->textFieldRow($model, 'for_position', array('class' => 'span4')); ?>

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
