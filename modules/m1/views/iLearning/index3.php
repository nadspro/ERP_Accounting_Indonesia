<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'I Learnings',
);

$this->menu = array(
    array('label' => 'Learning Calendar', 'url' => array('/m1/iLearning')),
    array('label' => 'List By Subject', 'url' => array('/m1/iLearning/index2')),
);


//$this->menu5=array('Sylabus');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-book"></i>
        Learning List by Date
    </h1>
</div>



<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'i-learning-sch-grid',
    'dataProvider' => iLearningSch::model()->searchByDate(),
    //'filter'=>$model,
    'columns' => array(
        array(
            'name' => 'schedule_date',
            'type' => 'raw',
            'value' => 'CHtml::link($data->schedule_date,Yii::app()->createUrl("/m1/iLearning/viewDetail",array("id"=>$data->id)))',
        ),
        array(
            'header' => 'Subject',
            'type' => 'raw',
            'value' => 'CHtml::link($data->getparent->learning_title,Yii::app()->createUrl("/m1/iLearning/view",array("id"=>$data->parent_id)))',
        ),
        'trainer_name',
        'location',
        'additional_info',
        array(
            'name' => 'status_id',
            'value' => '$data->status->name',
        ),
    //array(
    //	'class'=>'CButtonColumn',
    //),
    ),
));

