<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'method' => 'get',
    'id' => 'searchForm',
    'htmlOptions' => array('class' => 'form-inline'),
        ));
?>

<?php echo $form->textField($model, 'subject', array('class' => 'span7', 'maxlength' => 100)); ?>

<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class' => 'btn', 'type' => 'submit')); ?>

<?php $this->endWidget(); ?>

