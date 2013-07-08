<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>


<div class="page-header">
    <h1>
        <i class="icon-fa-leaf"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'cpersonalia-Attendance-grid',
    'dataProvider' => gAttendance::model()->search((int) $model->id, 0),
    'template' => '{items}',
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'template' => '{summary}{items}{pager}',
    //'filter'=>$model,
    'columns' => array(
        array(
            'name' => 'cdate',
            'value' => '$data->cdate',
        ),
        array(
            'header' => 'Pattern',
            'type' => 'raw',
            'value' => function($data1) {
                return
                        CHtml::tag('div', array(), (isset($data1->realpattern)) ? $data1->realpattern->code : "")
                        . CHtml::tag('div', array('style' => 'font-size: 11px;'), peterFunc::toTime($data1->realpattern->in) . " - " . peterFunc::toTime($data1->realpattern->out));
            }
        ),
        array(
            'name' => 'in',
            'type' => 'raw',
            'value' => function($data3) {
                return
                        (peterFunc::isTimeMore($data3->in, $data3->realpattern->in)) ?
                        CHtml::tag('div', array('style' => 'color: red;'), $data3->actualIn)
                        . CHtml::tag('div', array('style' => 'color: red;font-size: 11px;'), $data3->lateInStatus) : $data3->actualIn;
            }
        ),
        array(
            'name' => 'out',
            'type' => 'raw',
            'value' => function($data2) {
                return
                        (peterFunc::isTimeMore($data2->realpattern->out, $data2->out)) ?
                        CHtml::tag('div', array('style' => 'color: red;'), $data2->actualOut)
                        . CHtml::tag('div', array('style' => 'color: red;font-size: 11px;'), $data2->earlyOutStatus) : $data2->actualOut;
            }
        ),
        array(
            'header' => 'Status',
            'type' => 'raw',
            'value' => function($data) {
                return
                        CHtml::tag('div', array(), $data->OkName)
                        . CHtml::tag('div', array(), isset($data->permission1) ? $data->permission1->name : "")
                        . CHtml::tag('div', array(), isset($data->permission2) ? $data->permission2->name : "")
                        . CHtml::tag('div', array(), isset($data->permission3) ? $data->permission3->name : "");
            }
        ),
    ),
));
?>

