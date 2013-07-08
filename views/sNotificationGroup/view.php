<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */

$this->breadcrumbs = array(
    'S Notification Groups' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/sNotificationGroup')),
    array('label' => 'Update', 'url' => array('update', 'id' => $model->id)),
);

$this->menu1 = sNotificationGroup::getTopUpdated();
$this->menu2 = sNotificationGroup::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-reorder"></i>
        Notification Group
    </h1>
</div>


<?php
$this->widget('TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'group_name',
        'group_description',
        array(
            'label' => 'Status',
            'name' => 'status.name',
        ),
    ),
));
?>

<?php
$this->widget('TbGridView', array(
    'id' => 's-notification-group-member-grid',
    'dataProvider' => sNotificationGroupMember::model()->searchParent($model->id),
    'template' => '{items}',
    'columns' => array(
        array(
            'header' => 'User Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->user->username,Yii::app()->createUrl("/sUser/view",array("id"=>$data->user->id)))',
        ),
        array(
            'header' => 'Default Group',
            'value' => '$data->user->organization->name',
        ),
        'status_id',
        array(
            'class' => 'TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/sNotificationGroup/deleteNotificationGroupMember",array("id"=>$data->id))',
        ),
    ),
));
?>

<h3>New Notification Group Member</h3>

<?php echo $this->renderPartial('_formNotificationGroupMember', array('model' => $modelNotificationGroupMember)); ?>