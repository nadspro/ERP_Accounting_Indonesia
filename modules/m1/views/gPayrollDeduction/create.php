<?php
/* @var $this GPayrollDeductionController */
/* @var $model gPayrollDeduction */

$this->breadcrumbs=array(
	'G Payroll Deductions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List gPayrollDeduction', 'url'=>array('index')),
	array('label'=>'Manage gPayrollDeduction', 'url'=>array('admin')),
);
?>

<h1>Create gPayrollDeduction</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>