<?php

$this->widget('TbGridView', array(
    'id' => 'g-recruitment-grid',
    'dataProvider' => gSelection::model()->search('invitedresult'),
    'enableSorting' => false,
    'template' => '{items}{pager}',
    //'filter'=>$model,
    'columns' => array(
        array(
            'type' => 'raw',
            'value' => 'CHtml::link($data->PhotoPath,Yii::app()->createUrl("/' . $this->route . '/../view",array("id"=>$data->id,)))',
            'htmlOptions' => array("width" => "40px"),
        ),
        array(
            'header' => 'Candidate Name',
            'type' => 'raw',
            'value' => function($data) {
                return CHtml::tag('div', array(), CHtml::link($data->candidate_name, Yii::app()->createUrl("/m1/gSelection/view", array("id" => $data->id))))
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), 'Invited')
                        . CHtml::tag('div', array('style' => 'font-size: 11px'), $data->invitation_status->getWorkflowResult())
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), waktu::nicetime(strtotime($data->input_date)));
            }
        ),
        'for_position',
        array(
            'header' => 'Company / Dept',
            'type' => 'raw',
            'value' => function($data) {
                return CHtml::tag('div', array(), $data->company->name)
                        . CHtml::tag('div', array(), $data->department->name);
            }
        ),
        array(
            'header' => 'Email / HP ',
            'type' => 'raw',
            'value' => function($data) {
                return CHtml::tag('div', array(), $data->email)
                        . CHtml::tag('div', array(), $data->handphone);
            }
        ),
        //'invitation_status.workflow_result.name',
        //'quick_background',
        //'work_experience',
        //'sallary_expectation',
        array(
            'class' => 'TbButtonColumn',
            'template' => '{delete}',
            'visible' => '$data->company_id == sUser::model()->getGroup()',
        ),
    ),
));
