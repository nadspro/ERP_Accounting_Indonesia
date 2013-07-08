<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 's-group-grid',
    'dataProvider' => sNotificationGroupMember::model()->search($model->id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    //'filter'=>$model,
    'columns' => array(
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("sUser/deleteNotificationGroup",array("id"=>$data->id))',
        ),
        'parent.group_name',
        'parent.group_description',
    ),
));
?>

<hr>
<?php
//$this->renderPartial('_formGroup', array('model'=>$modelGroup));
?>

