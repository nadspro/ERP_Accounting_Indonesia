<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'gperson-training-nf-grid',
    'dataProvider' => gPersonTraining::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions'=>array(
    	'style'=>'padding-top:0'
    ),
    'columns' => array(
        'type.name',
        'topic',
        'instructor',
        'duration',
        'sertificate:boolean',
        'organizer',
        'place',
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteTraining",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'm1/gPerson/updateTraining',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Training',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
            'visible' => ($this->id == "gPerson")
        ),
    ),
));

