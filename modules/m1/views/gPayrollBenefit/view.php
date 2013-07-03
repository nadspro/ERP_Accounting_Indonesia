<?php
/* @var $this GPayrollBenefitController */
/* @var $model gPayrollBenefit */

$this->breadcrumbs=array(
	'G Payroll Benefits'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List gPayrollBenefit', 'url'=>array('index')),
	array('label'=>'Create gPayrollBenefit', 'url'=>array('create')),
	array('label'=>'Update gPayrollBenefit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete gPayrollBenefit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage gPayrollBenefit', 'url'=>array('admin')),
);
?>

<h1>View gPayrollBenefit #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'yearmonth_start',
		'yearmonth_end',
		'benefit_id',
		'remark',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by',
	),
)); ?>
