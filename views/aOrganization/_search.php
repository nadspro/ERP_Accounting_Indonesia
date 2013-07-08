<?php

/** @var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'method' => 'get',
    'id' => 'searchForm',
    //'action'=>Yii::app()->createUrl('/m1/gPerson/view',array("id"=>$_GET['name']),
    'htmlOptions' => array('class' => 'form-inline'),
        ));
?>

<?php echo $form->textField($model, 'name', array('class' => 'span3')); ?>
<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class' => 'btn', 'type' => 'submit')); ?>

<?php $this->endWidget(); ?>

