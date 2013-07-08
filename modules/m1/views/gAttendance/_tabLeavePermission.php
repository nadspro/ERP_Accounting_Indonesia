<h3>Leave</h3>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-leave-grid',
    'dataProvider' => gLeave::model()->leaveById($model->id, $month),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        'start_date',
        'end_date',
        'number_of_day',
        'leave_reason',
    ),
));
?>

<h4>Permission</h4>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-permission-grid',
    'dataProvider' => gPermission::model()->permissionById($model->id, $month),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        'start_date',
        'end_date',
        'number_of_day',
        array(
            'header' => 'Permission Type',
            'value' => '$data->permission_type->name',
        ),
        array(
            'header' => 'Status',
            'value' => '$data->approved->name',
        ),
        'permission_reason'
    ),
));

