<?php
$this->breadcrumbs = array(
    'G people',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gAttendance')),
    array('label' => 'Schedule Upload', 'icon' => 'calendar', 'url' => array('timeBlock')),
    array('label' => 'Attendant Upload', 'icon' => 'user', 'url' => array('attendBlock')),
);

$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-key"></i>
        Param Time Block
    </h1>
</div>



<?php
$this->widget('TbGridView', array(
    'id' => 'g-param-timeblock-grid',
    'dataProvider' => gParamTimeblock::model()->search(),
    //'filter'=>$model,
    'columns' => array(
        'id',
        'code',
        array(
            'name' => 'in',
            'value' => 'peterFunc::toTime($data->in)',
        ),
        array(
            'name' => 'out',
            'value' => 'peterFunc::toTime($data->out)',
        ),
        array(
            'name' => 'rest_in',
            'value' => 'peterFunc::toTime($data->rest_in)',
        ),
        array(
            'name' => 'rest_out',
            'value' => 'peterFunc::toTime($data->rest_out)',
        ),
        'remark',
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gAttendance/deleteParamTimeblock",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'm1/gAttendance/updateParamTimeblock',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Param Time Block',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    //array(
    //	'class'=>'TbButtonColumn',
    //	'template'=>'{delete}{update}',
    //	'deleteButtonUrl'=>'Yii::app()->createUrl("/m1/gHrParameter/deleteParamTimeblock",array("id"=>$data->id))',
    //),
    ),
));
?>

<div class="page-header">
    <h3>New Param Time Block</h3>
</div>

<?php
echo $this->renderPartial('_formParamTimeblock', array('model' => $model));
