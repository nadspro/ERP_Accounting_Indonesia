<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-person-grid',
    'dataProvider' => gPermission::model()->onWaiting(),
    //'filter'=>$model,
    'template' => '{items}{pager}',
    'columns' => array(
        array(
            'type' => 'raw',
            'value' => '$data->person->photoPath',
            'htmlOptions' => array("width" => "50px"),
        ),
        array(
            'header' => 'Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->person->employee_name,Yii::app()->createUrl("/m1/gPermission/view",array("id"=>$data->parent_id)))',
        ),
        array(
            'header' => 'Department',
            'name' => 'person.company.department.name',
        ),
        'start_date',
        'end_date',
        'number_of_day',
        array(
            'header' => 'Permission Type',
            'value' => '$data->permission_type->name',
        ),
        'permission_reason',
        array(
            'header' => 'Status',
            'value' => '$data->approved->name',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            //'template'=>'{update}{delete}',
            'template' => '{delete}',
            //'updateButtonUrl'=>'Yii::app()->createUrl("/m1/gPermission/update",array("id"=>$data->id))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gPermission/delete",array("id"=>$data->id))',
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{print}',
            'buttons' => array
                (
                'print' => array
                    (
                    'label' => 'Print',
                    'url' => 'Yii::app()->createUrl("/m1/gPermission/printPermission",array("id"=>$data->id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => array(
                        'class' => 'btn btn-mini',
                        'target' => '_blank',
                    ),
                ),
            ),
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{approved}',
            'buttons' => array
                (
                'approved' => array
                    (
                    'label' => 'Approved',
                    'url' => 'Yii::app()->createUrl("/m1/gPermission/approved",array("id"=>$data->id,"pid"=>$data->parent_id))',
                    'visible' => '$data->approved_id ==1',
                    'options' => array(
                        'ajax' => array(
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("g-person-grid", {
									data: $(this).serialize()
								});
								}',
                        ),
                        'class' => 'btn btn-mini',
                    ),
                ),
            ),
        ),
    ),
));

