<?php
$this->breadcrumbs = array(
    'G people',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gPersonHolding')),
    array('label' => 'Report', 'icon' => 'print', 'url' => array('/m1/gPersonHolding/report')),
);



$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        Person View
    </h1>
</div>

<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>


<?php
$this->widget('bootstrap.widgets.TbListView', array(
    //$this->widget('ext.EColumnListView', array(
    //'columns' => 3,
    'dataProvider' => $dataProvider,
    'itemView' => '/gPerson/_view',
));
