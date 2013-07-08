<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-education-grid' . $data->applicant_id,
    'dataProvider' => hApplicantEducation::model()->search($data->applicant_id),
    //'filter'=>$model,
    'enableSorting' => false,
    'template' => '{items}',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    ),
    'type' => 'striped condensed',
    'columns' => array(
        array(
            'header' => 'Level',
            'value' => '$data->edulevel->name',
        ),
        'school_name',
        'city',
        'interest',
        'graduate',
        //'country',
        //'institution',
        'ipk',
    ),
));
