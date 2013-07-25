<?php
$this->breadcrumbs = array(
    'C Customers',
);

$this->menu = array(
    //array('label' => 'Home', 'icon'=>'home', 'url' => array('/m2/uCustomer')),
);
?>

<div class="page-header">
    <h1>
        Data Customer
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>