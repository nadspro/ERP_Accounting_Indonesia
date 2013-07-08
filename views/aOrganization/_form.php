<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'a-organization-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>

<?php echo $form->errorSummary($model); ?>


<?php //echo $form->textFieldRow($model,'branch_code_number',array('class'=>'span2',)); ?>
<?php echo $form->textFieldRow($model, 'branch_code', array('class' => 'span2',)); ?>
<?php echo $form->textFieldRow($model, 'name', array('class' => 'span4')); ?>
<?php echo $form->textFieldRow($model, 'custom1', array('class' => 'span1')); ?>
<?php echo $form->textFieldRow($model, 'custom2', array('class' => 'span1')); ?>
<?php echo $form->textFieldRow($model, 'custom3', array('class' => 'span1')); ?>
<?php echo $form->textAreaRow($model, 'address', array('rows' => 3, 'class' => 'span4')); ?>

<?php /*
  <?php echo $form->labelEx($model,'propinsi_id'); ?>
  <?php
  echo $form->dropDownList($model,'propinsi_id',sKabupatenPropinsi::items("Any"),
  array(
  'empty'=>'select Propinsi:',
  'ajax' => array(
  'type'=>'POST',
  'url'=>CController::createUrl('aOrganization/kabupatenUpdate'),
  'update'=>'#'.CHtml::activeId($model,'kabupaten_id'),
  )
  )
  );

  ?>
 */ ?>

<?php //echo $form->dropDownListRow($model,'kabupaten_id',array()); ?>

<?php echo $form->textFieldRow($model, 'pos_code', array('class' => 'span2')); ?>
<?php //echo $form->textFieldRow($model,'phone_code_area',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model, 'telephone', array('class' => 'span3')); ?>
<?php echo $form->textFieldRow($model, 'fax', array('class' => 'span3')); ?>
<?php echo $form->textFieldRow($model, 'email', array('class' => 'span4')); ?>
<?php echo $form->textFieldRow($model, 'website', array('class' => 'span4')); ?>
<?php echo $form->dropDownListRow($model, 'status_id', sParameter::items('cOrganizationStatus')); ?>


<div class="form-actions">
    <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create' : '<i class="icon-ok"></i> Save', array('class' => 'btn', 'type' => 'submit')); ?>
</div>

<?php $this->endWidget(); ?>

