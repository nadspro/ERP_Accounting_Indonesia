<?php
$this->breadcrumbs = array(
    'G people',
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/m1/gLeave')),
        //array('label'=>'Manage gPerson','url'=>array('admin')),
);


//$this->menu1=gLeave::getTopUpdated();
//$this->menu2=gLeave::getTopCreated();
$this->menu5 = array('Leave');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-suitcase"></i>
        Leave
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
        array('label' => 'Waiting for Approval', 'url' => Yii::app()->createUrl('/m1/gLeave')),
        array('label' => 'Approved Leave', 'url' => Yii::app()->createUrl('/m1/gLeave/onApproved')),
        array('label' => 'Pending State', 'url' => Yii::app()->createUrl('/m1/gLeave/onPending')),
        array('label' => 'Employee On Leave', 'url' => Yii::app()->createUrl('/m1/gLeave/onLeave')),
        array('label' => 'Recent Leave', 'url' => Yii::app()->createUrl('/m1/gLeave/onRecent'), 'active' => true),
    ),
));
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-person-grid',
    'dataProvider' => gLeave::model()->OnRecent(),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        array(
            'type' => 'raw',
            'value' => '$data->person->photoPath',
            'htmlOptions' => array("width" => "50px"),
        ),
        array(
            'header' => 'Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->person->employee_name,Yii::app()->createUrl("/m1/gLeave/view",array("id"=>$data->parent_id)))',
        ),
        array(
            'header' => 'Department',
            'value' => '$data->person->mDepartment()',
        ),
        'start_date',
        'end_date',
        'number_of_day',
        'balance',
        array(
            'header' => 'Approved By',
            'name' => 'updated.username',
        ),
    ),
));
