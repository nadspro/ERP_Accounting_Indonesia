<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action' => Yii::app()->createUrl('/sCompanyNews/index'),
    'method' => 'get',
    'id' => 'searchForm',
    'htmlOptions' => array('class' => 'form-inline'),
        ));
?>

<?php echo $form->textField($model, 'title', array('class' => 'span7', 'maxlength' => 100)); ?>

<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class' => 'btn', 'type' => 'submit')); ?>

<?php $this->endWidget(); ?>

