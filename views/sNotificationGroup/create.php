<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */

$this->breadcrumbs = array(
    'S Notification Groups' => array('index'),
    'Create',
);

$this->menu = array(
    //array('label' => 'List sNotificationGroup', 'url' => array('index')),
    //array('label' => 'Manage sNotificationGroup', 'url' => array('admin')),
);

$this->menu1 = sNotificationGroup::getTopUpdated();
$this->menu2 = sNotificationGroup::getTopCreated();

?>

<div class="page-header">
    <h1>		<i class="icon-fa-reorder"></i>Create New Notification Group</h1>
</div>


<?php echo $this->renderPartial('_form', array('model' => $model)); ?>