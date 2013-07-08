
<?php

$form = $this->beginWidget('TbActiveForm', array(
    'action' => Yii::app()->createUrl('/sUser/sso', array("id" => $model->id)),
    'method' => 'post',
    'type' => 'inline',
        ));
?>

<?php

$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'model' => $model,
    'attribute' => 'sso_name',
    'sourceUrl' => Yii::app()->createUrl('/m1/gPerson/personAutoCompleteIdAdmin'),
    'options' => array(
        'minLength' => '2',
        'focus' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'sso_name') . '").val(ui.item.label);
					return false;
				}',
        'select' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'sso_id') . '").val(ui.item.id);
					return false;
				}',
    ),
    'htmlOptions' => array(
    ),
));
?>

<?php echo $form->hiddenField($model, 'sso_id', array()); ?>

<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Assign', array('class' => 'btn', 'type' => 'submit')); ?>

<?php $this->endWidget(); ?>
