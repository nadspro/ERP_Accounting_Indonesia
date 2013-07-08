<?php
$this->breadcrumbs = array(
    'Person Holding',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gPersonHolding')),
        //array('label'=>'Manage gPerson','url'=>array('admin')),
);



$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        Report
    </h1>
</div>

<ul>
    <li>
<?php echo CHtml::link('Report Multi Position Employee', Yii::app()->createUrl('/m1/gPersonHolding/report1')); ?>
    </li>
</ul>
