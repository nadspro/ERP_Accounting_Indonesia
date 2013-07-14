<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 's-group-grid',
    'dataProvider' => sUserGroup::model()->search($model->id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    //'filter'=>$model,
    'columns' => array(
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("sUser/deleteGroup",array("id"=>$data->id))',
        ),
        'organization_root.name',
    ),
));
?>

<hr>
<?php
$this->renderPartial('_formGroup', array('model' => $modelGroup));
?>

