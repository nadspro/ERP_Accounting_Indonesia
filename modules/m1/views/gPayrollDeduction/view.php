<?php
/* @var $this GPayrollDeductionController */
/* @var $model gPayrollDeduction */

$this->breadcrumbs=array(
	'G Payroll Deductions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List gPayrollDeduction', 'url'=>array('index')),
	array('label'=>'Create gPayrollDeduction', 'url'=>array('create')),
	array('label'=>'Update gPayrollDeduction', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete gPayrollDeduction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage gPayrollDeduction', 'url'=>array('admin')),
);
?>

<h1>View gPayrollDeduction #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'yearmonth_start',
		'yearmonth_end',
		'deduction_id',
		'remark',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by',
	),
)); ?>
