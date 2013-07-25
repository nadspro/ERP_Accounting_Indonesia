<?php
$this->breadcrumbs = array(
    'C Customers' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/uCustomer')),
    array('label' => 'View', 'icon' => 'pencil', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Delete', 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);

?>

<div class="page-header">
    <h1>
        Update: 
        <?php echo $model->company_name; ?>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>