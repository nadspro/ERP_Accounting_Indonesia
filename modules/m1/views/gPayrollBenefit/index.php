<?php
/* @var $this GPayrollBenefitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'G Payroll Benefits',
);

$this->menu=array(
	array('label'=>'Create gPayrollBenefit', 'url'=>array('create')),
	array('label'=>'Manage gPayrollBenefit', 'url'=>array('admin')),
);
?>

<h1>G Payroll Benefits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
