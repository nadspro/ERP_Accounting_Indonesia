<?php

$form = $this->beginWidget('TbActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'id' => 'searchForm',
    'htmlOptions' => array('class' => 'form-inline'),
        ));
?>

<?php

$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'model' => $model,
    'attribute' => 'account_name',
    'source' => $this->createUrl('/m2/tAccount/accountAutoComplete'),
    'options' => array(
        'minLength' => '2',
        'focus' => 'js:function( event, ui ) {
						$("#' . CHtml::activeId($model, 'account_name') . '").val(ui.item.label);
						return false;
					}',
        'select' => 'js:function( event, ui ) {
						$("#searchForm").submit();
						return false;
					}',
    ),
    'htmlOptions' => array(
        'class' => 'span4',
        'placeholder' => 'Search Account Name',
    ),
));
?>

<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class' => 'btn', 'type' => 'submit')); ?>

<?php $this->endWidget(); ?>
