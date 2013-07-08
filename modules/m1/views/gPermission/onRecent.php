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
        array('label' => 'Pending State', 'url' => Yii::app()->createUrl('/m1/gPermission/onPending')),
        array('label' => 'Employee On Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onPermission')),
        array('label' => 'Recent Permission', 'url' => Yii::app()->createUrl('/m1/gPermission/onRecent'), 'active' => true),
    ),
));
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-person-grid',
    'dataProvider' => gPermission::model()->OnRecent(),
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
    ),
));
