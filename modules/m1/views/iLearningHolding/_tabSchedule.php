<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'i-learning-sch-grid',
    'dataProvider' => iLearningSch::model()->search($model->id),
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
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'status_id',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(
                'url' => $this->createUrl('/m1/iLearningHolding/updateMandaysAjax'),
                'type' => 'select',
                'source' => sParameter::items("cTrainingStatus"),
            )
        ),
        //'status.name',
        'actual_mandays'
    ),
));
?>

<div class="page-header">
    <h3>New Schedule</h3>
</div>

<?php
echo $this->renderPartial('_formSchedule', array('model' => $modelSchedule));
