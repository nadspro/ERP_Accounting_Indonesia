<?php

$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'i-learning-sch-grid',
    'dataProvider' => iLearningSch::model()->search($model->id),
    'columns' => array(
        array(
            'name' => 'schedule_date',
            'type' => 'raw',
            'value' => 'CHtml::link($data->schedule_date,Yii::app()->createUrl("/m1/iLearning/viewDetail",array("id"=>$data->id)))',
        ),
        'trainer_name',
        'location',
        'additional_info',
        //array(
        //	'class'=>'TbButtonColumn',
        //	'template'=>'{update}{delete}',
        //),
        array(
            'name' => 'status_id',
            'value' => '$data->status->name',
        ),
    ),
));
