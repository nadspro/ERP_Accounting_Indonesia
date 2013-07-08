<?php

$this->widget('TbGridView', array(
    'id' => 'g-person-family-grid',
    'dataProvider' => gPersonFamily::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        'f_name',
        array(
            'header' => 'Relation',
            'value' => '$data->relation->name',
        ),
        'birth_place',
        'birth_date',
        array(
            'header' => 'Sex',
            'value' => '$data->sex->name',
        ),
        'remark',
        //'payroll_cover_id',
        //array(
        //	'class'=>'TbButtonColumn',
        //	'template'=>'{delete}',
        //	'deleteButtonUrl'=>'Yii::app()->createUrl("m1/gPerson/deleteFamily",array("id"=>$data->id))',
        //),
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteFamily",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'm1/gPerson/updateFamily',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Family',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
            'visible' => ($this->id == "gPerson")
        ),
    ),
));
