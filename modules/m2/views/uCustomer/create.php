<?php
$this->breadcrumbs = array(
    'C Customers' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List uCustomer', 'url' => array('index')),
    array('label' => 'Manage uCustomer', 'url' => array('admin')),
);
?>

<div class="page-header">
    <h1>
        Create Customer
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>