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
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Waiting for Approval', 'url' => Yii::app()->createUrl('/m1/gPermission'), 'active' => true),
        array('label' => 'Approved Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onApproved')),
        array('label' => 'Pending State', 'url' => Yii::app()->createUrl('/m1/gPermission/onPending')),
        array('label' => 'Employee On Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onPermission')),
        array('label' => 'Recent Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onRecent')),
    ),
));
?>

<?php
echo $this->renderPartial('onWaiting', array('model' => $model));