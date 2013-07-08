<?php
/* @var $this GPayrollReportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'G Payroll Reports',
);

$this->menu = array(
    array('label' => 'Create gPayrollReport', 'url' => array('create')),
    array('label' => 'Manage gPayrollReport', 'url' => array('admin')),
);
?>

<h1>G Payroll Reports</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
