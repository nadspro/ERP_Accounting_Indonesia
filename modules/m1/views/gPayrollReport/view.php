<?php
/* @var $this GPayrollReportController */
/* @var $model gPayrollReport */

$this->breadcrumbs = array(
    'G Payroll Reports' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List gPayrollReport', 'url' => array('index')),
    array('label' => 'Create gPayrollReport', 'url' => array('create')),
    array('label' => 'Update gPayrollReport', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete gPayrollReport', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage gPayrollReport', 'url' => array('admin')),
);
?>

<h1>View gPayrollReport #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'parent_id',
        'yearmonth',
        'basic_salary',
        'benefit',
        'deduction',
        'remark',
        'created_date',
        'created_by',
        'updated_date',
        'updated_by',
    ),
));
?>
