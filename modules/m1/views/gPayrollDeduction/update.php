<?php
/* @var $this GPayrollDeductionController */
/* @var $model gPayrollDeduction */

$this->breadcrumbs=array(
	'G Payroll Deductions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List gPayrollDeduction', 'url'=>array('index')),
	array('label'=>'Create gPayrollDeduction', 'url'=>array('create')),
	array('label'=>'View gPayrollDeduction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage gPayrollDeduction', 'url'=>array('admin')),
);
?>

<h1>Update gPayrollDeduction <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>