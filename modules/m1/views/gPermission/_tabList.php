<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    //$this->widget('ext.groupgridview.GroupGridView', array(
    //'extraRowColumns' => array('start_date'),
    'id' => 'g-permission-grid',
    'dataProvider' => gPermission::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        //'start_date',
        'start_date',
        'end_date',
        'number_of_day',
        //'work_date',
        'permission_reason',
        array(
            'header' => 'State',
            'value' => '$data->approved->name',
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{approved}',
            'buttons' => array
                (
                'approved' => array
                    (
                    'label' => 'Approved',
                    'url' => 'Yii::app()->createUrl("/m1/gPermission/approved",array("id"=>$data->id,"pid"=>$data->person->id))',
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
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPermission/delete",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'm1/gPermission/update',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Permission',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    ),
));
