<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 't-account-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->dropDownListRow($model, 'haschild_id', array("Yes" => "Yes", "No" => "No"), array(
    //'disabled'=>!empty($model->hasJournal),
    'hint' => 'Dropdown will disabled automatically when this account already has journal voucher on current period',
));
?>
<?php echo $form->textFieldRow($model, 'account_no', array('class' => 'span3')); ?>
<?php echo $form->textFieldRow($model, 'account_name', array('class' => 'span3')); ?>
<?php echo $form->textAreaRow($model, 'short_description', array('class' => 'span5', 'rows' => 3)); ?>
<?php //echo $form->dropDownListRow($model,'currency_id',sParameter::items("cCurrency","*inherited*")); ?>
<?php //echo $form->dropDownListRow($model,'state_id',sParameter::items("cStatus","*inherited*")); ?>

<?php
$this->widget('ext.appendo.JAppendo', array(
    'id' => 'repeateEnum',
    'model' => $model,
    'viewName' => '_accountProperties',
    'labelDel' => 'Remove Row',
    'appendoPath' => '/modules/m2/views/jAppendo/',
        //'cssFile' => 'css/jquery.appendo2.css'
));
?>

<div class="form-actions">
    <?php echo CHtml::htmlButton('<i class="icon-ok"></i>' . 'Save', array('class' => 'btn', 'type' => 'submit')); ?>
</div>

<?php $this->endWidget(); ?>
