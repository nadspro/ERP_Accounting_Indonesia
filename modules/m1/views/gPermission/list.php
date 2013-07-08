<?php
$this->breadcrumbs = array(
    'G people',
);

$this->menu4 = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gPermission')),
);


//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
$this->menu5 = array('Permission');
?>


<div class="page-header">
    <h1>
        <i class="icon-fa-medkit"></i>
        Permission
    </h1>
</div>

<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
