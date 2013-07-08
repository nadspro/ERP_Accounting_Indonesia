<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>


<div class="page-header">
    <h1>
        <i class="icon-fa-leaf"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-permission-grid',
    'dataProvider' => gPermission::model()->search($model->id),
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
        'permission_reason',
        array(
            'header' => 'State',
            'value' => '$data->approved->name',
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{cupdate}',
            'buttons' => array
                (
                'cupdate' => array
                    (
                    'label' => 'Update',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/updatePermission",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => array(
                        'class' => 'btn btn-mini',
                    ),
                ),
            ),
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{print}',
            'buttons' => array
                (
                'print' => array
                    (
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gEss/printPermission",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => array(
                        'class' => 'btn btn-mini',
                        'target' => '_blank',
                    ),
                ),
            ),
        ),
    ),
));

