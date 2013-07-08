<style>
    .userautocompletelink {height:52px;}
    .userautocompletelink img {float:left;margin-right:5px;width:40px;}

</style>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker1', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'start_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});

		$( \"#" . CHtml::activeId($model, 'superior_name') . "\" ).autocomplete({
			'minLength' : 2,
			'source': ' " . Yii::app()->createUrl('/m1/gPerson/personAutoCompletePhoto') . "',
			'focus': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'superior_name') . "\").val(ui.item.label);
			return false;
			},
			'select': function( event, ui ) {
			$(\"#" . CHtml::activeId($model, 'superior_id') . "\").val(ui.item.id);
			return false;
			},
			
		})
		.data( \"autocomplete\" )._renderItem = function( ul, item ) {
			return $( \"<li></li>\")
			.data( \"item.autocomplete\", item )
			.append('<a class=\'userautocompletelink\'><img src=\'" . Yii::app()->baseUrl . "/shareimages/hr/employee/thumb/" . "'+item.photo+'\'/><h5>'+item.label+'</h5></a>')
			.appendTo( ul );
		};
					
			
		});

		");
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'start_date', array('value' => date("d-m-Y"))); ?>

<?php //echo $form->dropDownListRow($model,'status_id',sParameter::items('cPromotion')); ?>
<?php echo $form->dropDownListRow($model, 'status_id', array('1' => 'Join (New)', '2' => 'Join (Continued)')); ?>

<div class="control-group">
    <?php echo $form->labelEx($model, 'company_id', array("class" => "control-label")); ?>
    <div class="controls">
        <?php
        echo $form->dropDownList($model, 'company_id', aOrganization::model()->companyDropDown(), array(
            'empty' => 'Select Company:',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/m1/gPerson/deptUpdate'),
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

<?php echo $form->textFieldRow($model, 'superior_name', array('class' => 'span3')); ?>
<?php echo $form->hiddenField($model, 'superior_id', array('class' => 'span3')); ?>

<?php
echo $form->textAreaRow($model, 'reason', array('class' => 'span4', 'rows' => 3));
