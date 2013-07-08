<?php

$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'i-learning-sch-grid3',
    'dataProvider' => iLearningSch::model()->search($model->id),
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
            'name' => 'status_id',
            'value' => '$data->status->name',
        ),
        /* has been disabled cause create format date dd-mm-yyyy to dd/mm/yyyy 
          array(
          'class' => 'ext.bootstrap.widgets.TbEditableColumn',
          'name' => 'status_id',
          //we need not to set value, it will be auto-taken from source
          // 'headerHtmlOptions' => array('style' => 'width: 60px'),
          'editable' => array(
          'type'    => 'select',
          'url'     => $this->createUrl('/m1/iLearningHolding/updateMandaysAjax'),
          'source'  => sParameter::items('cTrainingStatus'),
          )
          ), */
        array(
            'header' => 'Registrant',
            'name' => 'partCount',
            'htmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px;'
            ),
        ),
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/iLearningHolding/deleteSchedule",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'm1/iLearningHolding/updateSchedule',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Schedule',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    //array(
    //	'class'=>'CButtonColumn',
    //),
    ),
));

