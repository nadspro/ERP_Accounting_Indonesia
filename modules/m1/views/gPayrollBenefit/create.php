<?php
/* @var $this GPayrollBenefitController */
/* @var $model gPayrollBenefit */

$this->breadcrumbs=array(
	'G Payroll Benefits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List gPayrollBenefit', 'url'=>array('index')),
	array('label'=>'Manage gPayrollBenefit', 'url'=>array('admin')),
);
?>

<h1>Create gPayrollBenefit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>