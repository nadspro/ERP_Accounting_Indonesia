<?php
$this->breadcrumbs = array(
    'Person Holding',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/iLearning')),
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-print"></i>
        Report
    </h1>
</div>

<ul>
    <li>
        <?php echo CHtml::link('Training by Employee', Yii::app()->createUrl('/m1/iLearning/report2')); ?>
    </li>
    <li>
        <?php echo CHtml::link('Training by Month', Yii::app()->createUrl('/m1/iLearning/report3')); ?>
    </li>
</ul>
