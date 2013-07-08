<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */

$this->breadcrumbs = array(
    'S Notification Groups' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List sNotificationGroup', 'url' => array('index')),
    array('label' => 'Create sNotificationGroup', 'url' => array('create')),
    array('label' => 'View sNotificationGroup', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage sNotificationGroup', 'url' => array('admin')),
);
?>

<h1>
    <i class="icon-fa-reorder"></i>
    Update sNotificationGroup <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>