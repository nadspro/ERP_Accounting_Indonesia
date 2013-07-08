<?php

$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'i-learning-sch-grid1',
    'dataProvider' => iLearningSch::model()->search($model->id, true),
    //'filter'=>$model,
    'columns' => array(
        array(
            'name' => 'schedule_date',
            'type' => 'raw',
            'value' => 'CHtml::link($data->schedule_date,Yii::app()->createUrl("/m1/iLearningHolding/viewDetail",array("id"=>$data->id)))',
        ),
        'trainer_name',
        'location',
        'additional_info',
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'status_id',
            //we need not to set value, it will be auto-taken from source
            // 'headerHtmlOptions' => array('style' => 'width: 60px'),
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('/m1/iLearningHolding/updateMandaysAjax'),
                'source' => sParameter::items('cTrainingStatus'),
            )
        ),
        array(
            'name' => 'partCount',
            'htmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px;'
            ),
        ),
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name' => 'actual_mandays',
            'sortable' => false,
            'editable' => array(
                'url' => $this->createUrl('/m1/iLearningHolding/updateMandaysAjax'),
                //'placement' => 'right',
                'inputclass' => 'span1'
            )),
        array(
            'class' => 'ext.bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/iLearningHolding/deleteSchedule",array("id"=>$data->id))',
        ),
    ),
));

