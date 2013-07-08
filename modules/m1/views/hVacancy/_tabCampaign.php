<?php

$this->widget('TbGridView', array(
    'id' => 'g-vacancy-campaign-grid',
    'dataProvider' => hVacancyCampaign::model()->search($model->id),
    //'filter'=>$model,
    'type' => 'striped bordered condensed',
    'template' => '{items}',
    'columns' => array(
        'campaign_name',
        'start_date',
        'end_date',
        'location',
        'additional_info',
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteCampaign",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'm1/hVacancy/updateCampaign',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Campaign',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    ),
));
