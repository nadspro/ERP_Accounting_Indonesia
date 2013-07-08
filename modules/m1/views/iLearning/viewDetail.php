<?php
$this->breadcrumbs = array(
    'I Learning Sches' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/m1/iLearning')),
    array('label' => $model->getparent->learning_title, 'url' => array('/m1/iLearning/view', 'id' => $model->parent_id)),
);
?>

<div class="page-header">
    <h1><i class="icon-fa-book"></i>
        <?php echo $model->getparent->learning_title; ?> | <?php echo $model->schedule_date ?></h1>
</div>

<?php
$this->widget('ext.bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'getparent.objective',
        'getparent.outline',
        'getparent.participant',
        'getparent.duration',
        array(
            'name' => 'getparent.type_id',
            'value' => $model->getparent->type->name,
        ),
    ),
));
?>
<br/>

<?php
$this->widget('ext.bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'trainer_name',
        'location',
        'schedule_date',
        'additional_info',
        array(
            'name' => 'status_id',
            'value' => $model->status->name,
        ),
    ),
));
?>


<div class="row">
    <div class="span3">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td  align="center"><h3><?php echo $model->mPartCount ?></h3>
                    <h6 align="center" ><font COLOR="#999">Total Participant</font></h6></td>
            </tr>
        </table>
    </div>

    <div class="span3">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td  align="center"><h3><?php echo $model->partCountFb ?></h3>
                    <h6 align="center" ><font COLOR="#999">Total Feedback</font></h6></td>
            </tr>
        </table>
    </div>

    <div class="span3">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td  align="center"><h3><?php echo $model->partResult ?></h3>
                    <h6 align="center" ><font COLOR="#999">Final Result</font></h6></td>
            </tr>
        </table>
    </div>
</div>


<?php
if (is_dir(Yii::app()->basePath . "/../shareimages/hr/learning/" . $model->id))
    $this->renderPartial('/iLearningHolding/_tabPhotoView', array("id" => $model->id));
?>


<?php if ($model->status_id == 1 && strtotime($model->schedule_date) >= time()) { ?>

    <div class="page-header">
        <h3>New Participant</h3>
    </div>

    <?php echo $this->renderPartial('/iLearning/_formParticipant', array('model' => $modelParticipant)); ?>

<?php } ?>

<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'i-learning-sch-part-grid',
    'dataProvider' => iLearningSchPart::model()->search($model->id),
    //'filter'=>$model,
    'columns' => array(
        //'employee.employee_name',
        array(
            //'header'=>'employee_id',
            'type' => 'raw',
            'value' => '$data->employee->PhotoPath',
            'htmlOptions' => array(
                'class' => 'span1',
            ),
        ),
        array(
            'name' => 'employee_id',
            'value' => '$data->employee->employee_name ." - ".$data->employee->mCompany()',
        ),
        array(
            'name' => 'flow_id',
            'value' => '$data->flow->name',
        ),
        array(
            'header' => 'Result',
            'value' => '$data->resultFeedback'
        ),
    //'day1',
    //'day2',
    //'day3',
    //'day4',
    //array(
    //	'class'=>'TbButtonColumn',
    //	'template'=>'{update}{delete}',
    //),
    ),
));
?>

<br/>
<div class="pull-right">
    <strong>Displayed only Participant from Current Company</strong>
</div>
<br/>
