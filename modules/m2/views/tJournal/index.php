<?php
$this->breadcrumbs = array(
    'Journal Voucher',
);

$this->menu = array(
        //array('label'=>'Home', 'icon'=>'home','url'=>array('/m2/tJournal')),
);


$this->menu1 = tJournal::getTopUpdated(1);
$this->menu2 = tJournal::getTopCreated(1);
$this->menu5 = array('Journal');

$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m2/tJournal/index'));
?>
<div class="page-header">
    <h1>
        Journal Voucher
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'template' => '{items}{pager}',
    'itemView' => '/tJournal/_view',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    )
));
?>

