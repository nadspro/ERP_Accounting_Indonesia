<?php
$this->breadcrumbs = array(
    'G people',
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/m1/gPerson')),
        //array('label'=>'Manage gPerson','url'=>array('admin')),
);



$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gTalent/index'));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-beaker"></i>
        Talent
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    //$this->widget('ext.EColumnListView', array(
    //'columns' => 3,
    'dataProvider' => $dataProvider,
    'itemView' => '/gPerson/_view',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    )
));

