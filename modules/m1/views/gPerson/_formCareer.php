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
			.append('<a style=\'height:52px;\'><img style=\'float:left;margin-right:5px;width:40px; \'src=\'" . Yii::app()->baseUrl . "/shareimages/hr/employee/thumb/" . "'+item.photo+'\'/><h5>'+item.label+'</h5></a>')
			.appendTo( ul );
		};
			
		});

		");
?>

<div class="row">
    <div class="span9">

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'g-karir-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'start_date', array()); ?>

        <?php echo $form->dropDownListRow($model, 'status_id', sParameter::items('cPromotion', 0, array(7, 8))); ?>

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

        <?php echo $form->textAreaRow($model, 'reason', array('class' => 'span4', 'rows' => 3)); ?>

        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ));
            ?>

            <?php /* 	
              <?php echo CHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(array('/m1/gPerson/updateCareerAjax','id'=>$model->id)),
              array(
              'dataType'=>'json',
              'type'=>'post',
              'success'=>'function(data) {
              $.fn.yiiGridView.update("g-karir-grid");
              }',
              ),
              array('id'=>'mybtn','class'=>'btn btn-primary'));
              ?>
             */ ?>	
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
