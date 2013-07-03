<?php
/* @var $this GPayrollBenefitController */
/* @var $model gPayrollBenefit */

$this->breadcrumbs=array(
	'G Payroll Benefits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List gPayrollBenefit', 'url'=>array('index')),
	array('label'=>'Create gPayrollBenefit', 'url'=>array('create')),
	array('label'=>'View gPayrollBenefit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage gPayrollBenefit', 'url'=>array('admin')),
);
?>

<h1>Update gPayrollBenefit <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>