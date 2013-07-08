<?php
echo CHtml::link('Update Profile', Yii::app()->createUrl('/m1/hApplicant/update', array("id" => $model->id)), array("class" => "btn btn-mini", "style" => "margin-bottom:10px"));

//$this->widget('bootstrap.widgets.TbEditableDetailView', array(
//'url' => $this->createUrl('applicant/updatePerson'),
$this->widget('ext.XDetailView', array(
    'ItemColumns' => 1,
    'data' => $model,
    'attributes' => array(
        //array(
        //		'header'=>'Basic Info',
        //),
        //'applicant_code',
        array(
            'label' => 'Birth Place',
            'value' => $model->birth_place,
        ),
        'birth_date',
        array(
            'label' => 'Sex',
            'value' => isset($model->sex) ? $model->sex->name : "",
        ),
        array(
            'label' => 'Religion',
            'value' => $model->religion->name,
        ),
        //array(
        //		'label'=>'Marital Status',
        //		'value'=>$model->maritalstatus->name,
        //),
        //'blood_id',
        //array(
        //		'header'=>'Address and Domisili',
        //),
        'address1',
        /* 'address2',
          'address3',
          'pos_code', */
        //'identity_number',
        //'identity_valid',
        //'identity_address1',
        /* 'identity_address2',
          'identity_address3',
          'identity_pos_code', */
        //array(
        //		'header'=>'Contact',
        //),
        'email',
        //'email2',
        //'home_phone',
        'handphone',
        array(
            'name' => 'freshgrad_id',
            'value' => ($model->freshgrad_id == 1) ? "Yes" : "No",
        ),
    //'handphone2',
    //array(
    //		'header'=>'Bank Information',
    //),
    //'account_number',
    //'account_name',
    //'bank_name',
    ),
));
?>

<h3>Experience</h3>

<?php
$this->widget('TbGridView', array(
    'id' => 'g-person-experience-grid',
    'dataProvider' => hApplicantExperience::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    ),
    'columns' => array(
        'company_name',
        'industries',
        'start_date',
        'end_date',
        //'year_length',
        //'month_length',
        'job_title',
        //array(
        //	'class'=>'TbButtonColumn',
        //	'template'=>'{delete}',
        //	'deleteButtonUrl'=>'Yii::app()->createUrl("applicant/deleteExperience",array("id"=>$data->id))',
        //),
        array(
            //'visible'=>false,
            'class' => 'EJuiDlgsColumn',
            //'template'=>'{update}{delete}',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("applicant/deleteExperience",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'applicant/updateExperience',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Experience',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    ),
));
?>

<h3>Education</h3>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-education-grid',
    'dataProvider' => hApplicantEducation::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    ),
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
        array(
            //'visible'=>false,
            'class' => 'EJuiDlgsColumn',
            //'template'=>'{update}{delete}',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("applicant/deleteEducation",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'applicant/updateEducation',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Education',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    ),
));
?>

<h3>Family</h3>

<?php
$this->widget('TbGridView', array(
    'id' => 'g-person-family-grid',
    'dataProvider' => hApplicantFamily::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    ),
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
        array(
            //'visible'=>false,
            'class' => 'ext.quickdlgs.EJuiDlgsColumn',
            //'template'=>'{update}{delete}',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("applicant/deleteFamily",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'applicant/updateFamily',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Family',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    ),
));
?>

<h3>Non Formal Education</h3>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'gperson-education-nf-grid',
    'dataProvider' => hApplicantEducationNf::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    ),
    'columns' => array(
        'education_name',
        'category',
        'start',
        'end',
        'sertificate:boolean',
        'country',
        array(
            //'visible'=>false,
            'class' => 'EJuiDlgsColumn',
            //'template'=>'{update}{delete}',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("applicant/deleteEducationNf",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'applicant/updateEducationNf',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Non Formal Education',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    ),
));

