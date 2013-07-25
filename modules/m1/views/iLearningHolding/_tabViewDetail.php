<div class="row">
    <div class="pull-right">
        <?php echo CHtml::link('Confirm All', Yii::app()->createUrl('m1/iLearningHolding/confirmAll', array('id' => $model->id)), array('class' => 'btn btn-primary btn-mini')); ?>
    </div>
</div>


<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'i-learning-sch-part-grid',
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
            'value' => 'isset($data->employee) ? $data->employee->PhotoPath : ""',
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
            'class' => 'ext.editable.EditableColumn',
            'name' => 'flow_id',
            //we need not to set value, it will be auto-taken from source
            // 'headerHtmlOptions' => array('style' => 'width: 60px'),
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('/m1/iLearningHolding/updateParticipantAjax'),
                'source' => sParameter::items('cTrainingRegister'),
            )
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'day1',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(
                'url' => $this->createUrl('/m1/iLearningHolding/updateParticipantAjax'),
                'type' => 'select',
                'source' => array('1' => 'Present', '2' => 'Partial', '3' => 'Absence'),
            )
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'day2',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(
                'url' => $this->createUrl('/m1/iLearningHolding/updateParticipantAjax'),
                'type' => 'select',
                'source' => array('1' => 'Present', '2' => 'Partial', '3' => 'Absence'),
            )
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/iLearningHolding/deleteParticipant",array("id"=>$data->id))',
        ),
        array(
            'header' => 'FeedBack',
            'type' => 'raw',
            'value' => 'CHtml::link("Feedback",Yii::app()->createUrl("/m1/iLearningHolding/feedback",array("id"=>$data->id,"pid"=>$data->employee_id)),
						array("class"=>"btn btn-info btn-mini"))',
        ),
        array(
            'header' => 'Result',
            'value' => '$data->resultFeedback'
        ),
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name' => 'remark',
            'sortable' => false,
            'editable' => array(
                'type' => 'textarea',
                'url' => $this->createUrl('/m1/iLearningHolding/updateParticipantAjax'),
                //'placement' => 'right',
                'inputclass' => 'span3'
            )
        ),
        array(
            'header' => 'Inputed By',
            'name' => 'created.username'
        ),
    ),
));
