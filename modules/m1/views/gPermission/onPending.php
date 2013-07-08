<?php
$this->breadcrumbs = array(
    'G people',
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/m1/gPermission')),
        //array('label'=>'Manage gPerson','url'=>array('admin')),
);


//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
$this->menu5 = array('Permission');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-medkit"></i>
        Permission
    </h1>
</div>

<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Waiting for Approval', 'url' => Yii::app()->createUrl('/m1/gPermission')),
        array('label' => 'Approved Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onApproved')),
        array('label' => 'Pending State', 'url' => Yii::app()->createUrl('/m1/gPermission/onPending'), 'active' => true),
        array('label' => 'Employee On Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onPermission')),
        array('label' => 'Recent Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onRecent')),
    ),
));
?>


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-person-grid',
    'dataProvider' => gPermission::model()->onPending(),
    //'filter'=>$model,
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
            'header' => 'Status',
            'value' => '$data->approved->name',
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{unblock}',
            'buttons' => array
                (
                'unblock' => array
                    (
                    'label' => 'Unblock',
                    'url' => 'Yii::app()->createUrl("/m1/gPermission/unblock",array("id"=>$data->permission->id,"pid"=>$data->id))',
                    'visible' => '$data->permission->approved_id ==4',
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
