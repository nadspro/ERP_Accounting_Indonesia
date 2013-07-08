<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'cpersonalia-overtime-grid',
    'dataProvider' => gAttendance::model()->searchOvertime((int) $model->id, $month),
    'template' => '{items}',
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    //'filter'=>$model,
    'columns' => array(
        array(
            'header' => 'Permission',
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}',
            'updateDialog' => array(
                'controllerRoute' => '/m1/gAttendance/updateAttendance',
                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/ijin.png',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Attendance',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
        array(
            'name' => 'cdate',
            'value' => '$data->cdate',
        ),
        array(
            'header' => 'Pattern',
            'type' => 'raw',
            'value' => function($data1) {
                return
                        CHtml::tag('div', array(), $data1->realpattern->code)
                        . CHtml::tag('div', array(), peterFunc::toTime($data1->realpattern->in) . " - " . peterFunc::toTime($data1->realpattern->out));
            }
        ),
        array(
            'name' => 'in',
            'type' => 'raw',
            'value' => function($data3) {
                return
                        (peterFunc::isTimeMore($data3->in, $data3->realpattern->in)) ?
                        CHtml::tag('div', array('style' => 'color: red;'), $data3->actualIn)
                        . CHtml::tag('div', array('style' => 'color: red;'), $data3->lateInStatus) : $data3->actualIn;
            }
        ),
        array(
            'name' => 'out',
            'type' => 'raw',
            'value' => function($data2) {
                return
                        (peterFunc::isTimeMore($data2->realpattern->out, $data2->out)) ?
                        CHtml::tag('div', array('style' => 'color: red;'), $data2->actualOut)
                        . CHtml::tag('div', array('style' => 'color: red;'), $data2->earlyOutStatus) : $data2->actualOut;
            }
        ),
        'overtimeIn',
        'overtimeOut',
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
    //'remark',
    ),
));


