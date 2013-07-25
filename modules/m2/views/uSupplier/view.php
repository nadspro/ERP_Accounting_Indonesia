<?php
$this->breadcrumbs = array(
    'C Suppliers' => array('index'),
    $model->id,
);

$this->menu = array(
    //array('label'=>'Create','url'=>array('create')),
    array('label' => 'Update', 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete', 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);

$this->menu5 = array('Supplier');
?>

<div class="page-header">
    <h1>
        <?php echo $model->company_name; ?>
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'pic',
        'address',
        'city',
        'pos_code',
        'province',
        'telephone',
        'fax',
        'email',
        'status_id',
    ),
));
?>
