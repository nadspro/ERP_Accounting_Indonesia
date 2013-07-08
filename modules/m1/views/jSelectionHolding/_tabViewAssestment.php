<?php

$this->widget('TbGridView', array(
    'id' => 'j-selection-grid',
    'dataProvider' => jSelectionPart::model()->search($model->id),
    //'filter'=>$model,
    'columns' => array(
        array(
            'value' => 'CHtml::link($data->applicant->applicant_name,Yii::app()->createUrl("m1/hApplicant/view",array("id"=>$data->applicant_id)))',
            'type' => 'raw',
            'header' => 'Applicant Name',
        ),
        array(
            'name' => 'applicant.selection.workflow_by',
            'header' => 'Last Assestment By',
        ),
        array(
            'name' => 'applicant.selection.assestment_date',
            'header' => 'Last Assestment Date',
        ),
        array(
            'name' => 'applicant.selection.assestment_summary',
            'header' => 'Last Assestment Summary',
        ),
        array(
            'name' => 'applicant.selection.development_area',
            'header' => 'Last Development Area',
        ),
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}',
            'updateDialog' => array(
                'controllerRoute' => 'm1/jSelectionHolding/updateAssestment',
                'actionParams' => array('id' => '$data->applicant_id'),
                'dialogTitle' => 'New Assestment',
                'dialogWidth' => 600, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    ),
));
