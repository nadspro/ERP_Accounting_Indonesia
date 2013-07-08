<?php
/* @var $this GPayrollReportController */
/* @var $data gPayrollReport */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
    <?php echo CHtml::encode($data->parent_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('yearmonth')); ?>:</b>
    <?php echo CHtml::encode($data->yearmonth); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('basic_salary')); ?>:</b>
    <?php echo CHtml::encode($data->basic_salary); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('benefit')); ?>:</b>
    <?php echo CHtml::encode($data->benefit); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('deduction')); ?>:</b>
    <?php echo CHtml::encode($data->deduction); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
    <?php echo CHtml::encode($data->remark); ?>
    <br />

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
      <?php echo CHtml::encode($data->created_date); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
      <?php echo CHtml::encode($data->created_by); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('updated_date')); ?>:</b>
      <?php echo CHtml::encode($data->updated_date); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
      <?php echo CHtml::encode($data->updated_by); ?>
      <br />

     */ ?>

</div>