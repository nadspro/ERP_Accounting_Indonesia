<?php
/* @var $this GPayrollDeductionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'G Payroll Deductions',
);

$this->menu=array(
	array('label'=>'Create gPayrollDeduction', 'url'=>array('create')),
	array('label'=>'Manage gPayrollDeduction', 'url'=>array('admin')),
);
?>

<h1>G Payroll Deductions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
