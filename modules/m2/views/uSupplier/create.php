<?php
$this->breadcrumbs = array(
    'C Suppliers' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List uSupplier', 'url' => array('index')),
    array('label' => 'Manage uSupplier', 'url' => array('admin')),
);
?>

<div class="page-header">
    <h1>
        Create Supplier
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>