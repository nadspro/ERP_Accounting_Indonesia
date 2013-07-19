<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'gperson-training-holding-grid',
    'dataProvider' => iLearningSchPart::model()->searchByEmployee($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions'=>array(
    	'style'=>'padding-top:0'
    ),
    'columns' => array(
        'getparent.getparent.learning_title',
        'getparent.schedule_date',
        'getparent.trainer_name',
        'getparent.getparent.duration',
        'getparent.location',
        'resultFeedback',
    ),
));


