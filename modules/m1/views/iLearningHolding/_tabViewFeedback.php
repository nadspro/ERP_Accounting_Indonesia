<?php

$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'i-learning-sch-part-grid1',
    'dataProvider' => iLearningSchPart::model()->searchHolding($model->id),
    //'filter'=>$model,
    'columns' => array(
        array(
            'header' => '#No.',
            'value' => '$row+1',
            'htmlOptions' => array(
                'style' => 'text-align:right;margin-right:5px',
            ),
        ),
        array(
            'type' => 'raw',
            'value' => '$data->employee->PhotoPath',
            'htmlOptions' => array(
                'class' => 'span1',
            ),
        ),
        array(
            'header' => 'Employee Name',
            'type' => 'raw',
            'value' => function($data) {
                return CHtml::tag('div', array('style' => 'font-weight: bold'), $data->employee->employee_name)
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->employee->mCompany())
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->employee->mDepartment())
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->employee->mLevel());
            },
        ),
        array(
            'header' => 'Comment',
            'value' => 'isset($data->feedback->D1) ? $data->feedback->D1 : ""',
        ),
        array(
            'header' => 'Feedback',
            'value' => 'isset($data->feedback->D2) ? $data->feedback->D2 : ""',
        ),
    ),
));
