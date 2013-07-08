<?php
/* @var $this SNotificationGroupController */
/* @var $model sNotificationGroup */

$this->breadcrumbs = array(
    'Notification Groups' => array('index'),
    'Manage',
);

$this->menu = array(
        //array('label'=>'Create', 'url'=>array('create')),
);

$this->menu1 = sNotificationGroup::getTopUpdated();
$this->menu2 = sNotificationGroup::getTopCreated();
$this->menu5 = array('Notification Group');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-reorder"></i>
        Notification Group
    </h1>
</div>

<?php
$this->widget('TbGridView', array(
    'id' => 's-notification-group-grid',
    'dataProvider' => $model->search(),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        array(
            'name' => 'group_name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->group_name,Yii::app()->createUrl("/sNotificationGroup/view/",array("id"=>$data->id)))',
        ),
        'group_description',
        array(
            'header' => 'Status',
            'name' => 'status.name',
        ),
        array(
            'header' => 'Member',
            'type' => 'raw',
            'value' => '$data->userList',
        ),
    //array(
    //	'class'=>'TbButtonColumn',
    //),
    ),
));
?>
