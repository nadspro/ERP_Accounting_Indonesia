<?php
$this->breadcrumbs = array(
    'C Suppliers',
);

$this->menu = array(
    //array('label' => 'Home', 'icon'=>'home', 'url' => array('/m2/uSupplier')),
);
?>

<div class="page-header">
    <h1>
        Data Supplier
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>