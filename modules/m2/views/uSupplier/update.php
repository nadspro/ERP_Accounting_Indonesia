<?php
$this->breadcrumbs = array(
    'C Suppliers' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List uSupplier', 'url' => array('index')),
    array('label' => 'Create uSupplier', 'url' => array('create')),
    array('label' => 'View uSupplier', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage uSupplier', 'url' => array('admin')),
);
?>

<div class="page-header">
    <h1>
        Update uSupplier
        <?php echo $model->id; ?>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>