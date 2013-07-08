<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'opencases-grid',
    'dataProvider' => sFeedBack::model()->search(2),
    'itemsCssClass' => 'table table-striped',
    'template' => '{items}{pager}',
    'columns' => array(
        array(
            'class' => 'TbButtonColumn',
        ),
        array(
            'header' => 'Date',
            'value' => 'Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->sender_date)',
        ),
        'sender_ref',
        array(
            'header' => 'Sender',
            'name' => 'sender.username',
        ),
        array(
            'header' => 'Receiver',
            'name' => 'receiver.username',
        ),
        array(
            'header' => 'Category',
            'name' => 'category.name',
        ),
        'priority_level.name',
        array(
            'header' => 'Description',
            'type' => 'raw',
            'value' => 'CHtml::link(substr($data->long_desc,0,100),Yii::app()->createUrl("/sFeedback/view",array("id"=>$data->id)))',
        ),
        //array(
        //	'header'=>'Status',
        //	'name'=>'status.name',
        //),
        'commentCount',
    ),
));
?>
