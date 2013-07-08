<?php
/* @var $this GPayrollReportController */
/* @var $model gPayrollReport */

$this->breadcrumbs = array(
    'G Payroll Reports' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List gPayrollReport', 'url' => array('index')),
    array('label' => 'Create gPayrollReport', 'url' => array('create')),
    array('label' => 'View gPayrollReport', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage gPayrollReport', 'url' => array('admin')),
);
?>

<h1>Update gPayrollReport <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>