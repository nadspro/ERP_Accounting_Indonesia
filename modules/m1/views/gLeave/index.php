<?php
$this->breadcrumbs = array(
    'G people',
);

$this->menu4 = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gLeave')),
);

$this->menu = array(
    array('icon' => 'cog', 'label' => 'Cancellation Leave', 'url' => array('/m1/gLeave/cancellation')),
    array('icon' => 'cog', 'label' => 'Extended Leave', 'url' => array('/m1/gLeave/extended')),
);

$this->menu1 = array(
    array('icon' => 'print', 'label' => 'Rekap by Dept', 'url' => array('/m1/gLeave/reportByDept')),
);

$this->menu5 = array('Leave');
?>


<div class="page-header">
    <h1>
        <i class="icon-fa-suitcase"></i>
        Leave
    </h1>
</div>

<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Waiting for Approval', 'url' => Yii::app()->createUrl('/m1/gLeave'), 'active' => true),
        array('label' => 'Approved Leave', 'url' => Yii::app()->createUrl('/m1/gLeave/onApproved')),
        array('label' => 'Pending State', 'url' => Yii::app()->createUrl('/m1/gLeave/onPending')),
        array('label' => 'Employee On Leave', 'url' => Yii::app()->createUrl('/m1/gLeave/onLeave')),
        array('label' => 'Recent Leave', 'url' => Yii::app()->createUrl('/m1/gLeave/onRecent')),
    ),
));
?>

<?php
echo $this->renderPartial('onWaiting', array('model' => $model));