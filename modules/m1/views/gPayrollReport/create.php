<?php
/* @var $this GPayrollReportController */
/* @var $model gPayrollReport */

$this->breadcrumbs = array(
    'G Payroll Reports' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List gPayrollReport', 'url' => array('index')),
    array('label' => 'Manage gPayrollReport', 'url' => array('admin')),
);
?>

<h1>Create gPayrollReport</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>