<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'cpersonalia-Attendance-grid',
    'dataProvider' => gAttendance::model()->search((int) $model->id, $month),
    'template' => '{items}',
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'template' => '{summary}{items}{pager}',
    //'filter'=>$model,
    'columns' => array(
        array(
            'class' => 'TbButtonColumn',
            //'template'=>'{cuti}{sakit}{alpha}{tad}{tap}{ok}',
            'template' => '{cuti}{alpha}{lembur}',
            'htmlOptions' => array(
                'width' => '150px',
            ),
            'buttons' => array(
                'cuti' => array(
                    'label' => 'C',
                    'url' => 'Yii::app()->createUrl("/m1/gAttendance/setCuti", array("id"=>$data->id))',
                    'options' => array(
                        'ajax' => array(
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
								data: $(this).serialize()});
								$.fn.yiiGridView.update("cpersonalia-overtime-grid", {
								data: $(this).serialize()});
							}',
                        ),
                        'class' => 'btn btn-mini btn-primary',
                    ),
                    'visible' => '$data->daystatus3_id !=200 && $data->realpattern_id !=90',
                ),
                /* 'sakit' => array (
                  'label'=>'S',
                  'url'=>'Yii::app()->createUrl("/m1/gAttendance/setSakit", array("id"=>$data->id))',
                  'options'=>array(
                  'ajax'=>array(
                  'type'=>'GET',
                  'url'=>"js:$(this).attr('href')",
                  'success'=>'js:function(data){
                  $.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
                  data: $(this).serialize()});
                  }',
                  ),
                  'class'=>'btn btn-mini btn-warning',
                  'style'=>'margin-left:3px;',
                  ),
                  'visible'=>'$data->daystatus1_id !=10 && $data->realpattern_id !=90',
                  ), */
                'alpha' => array(
                    'label' => 'A',
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/alpha.png',
                    'url' => 'Yii::app()->createUrl("/m1/gAttendance/setAlpha", array("id"=>$data->id))',
                    'options' => array(
                        'ajax' => array(
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
								data: $(this).serialize()});
								$.fn.yiiGridView.update("cpersonalia-overtime-grid", {
								data: $(this).serialize()});
							}',
                        ),
                        'class' => 'btn btn-mini btn-danger',
                        'style' => 'margin-left:3px;',
                    ),
                    'visible' => '$data->daystatus3_id !=300 && $data->realpattern_id !=90',
                ),
                'lembur' => array(
                    'label' => 'L',
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/alpha.png',
                    'url' => 'Yii::app()->createUrl("/m1/gAttendance/setLembur", array("id"=>$data->id))',
                    'options' => array(
                        'ajax' => array(
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
								data: $(this).serialize()});
								$.fn.yiiGridView.update("cpersonalia-overtime-grid", {
								data: $(this).serialize()});
							}',
                        ),
                        'class' => 'btn btn-mini btn-success',
                        'style' => 'margin-left:10px;',
                    ),
                    'visible' => '$data->daystatus3_id !=400 && $data->realpattern_id !=90',
                ),
            /* 'tad' => array (
              'label'=>'TAD',
              //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/alpha.png',
              'url'=>'Yii::app()->createUrl("/m1/gAttendance/setTad", array("id"=>$data->id))',
              'options'=>array(
              'ajax'=>array(
              'type'=>'GET',
              'url'=>"js:$(this).attr('href')",
              'success'=>'js:function(data){
              $.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
              data: $(this).serialize()});
              $.fn.yiiGridView.update("cpersonalia-overtime-grid", {
              data: $(this).serialize()});
              }',
              ),
              'class'=>'btn btn-mini btn-info',
              'style'=>'margin-left:10px;',
              ),
              'visible'=>'$data->daystatus1_id ==null',
              ),
              'tap' => array (
              'label'=>'TAP',
              //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/alpha.png',
              'url'=>'Yii::app()->createUrl("/m1/gAttendance/setTap", array("id"=>$data->id))',
              'options'=>array(
              'ajax'=>array(
              'type'=>'GET',
              'url'=>"js:$(this).attr('href')",
              'success'=>'js:function(data){
              $.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
              data: $(this).serialize()});
              $.fn.yiiGridView.update("cpersonalia-overtime-grid", {
              data: $(this).serialize()});
              }',
              ),
              'class'=>'btn btn-mini btn-info',
              'style'=>'margin-left:3px;',
              ),
              'visible'=>'$data->daystatus1_id ==null',
              ),
              'ok' => array (
              'label'=>'OK',
              //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/alpha.png',
              'url'=>'Yii::app()->createUrl("/m1/gAttendance/setOk", array("id"=>$data->id))',
              'options'=>array(
              'ajax'=>array(
              'type'=>'GET',
              'url'=>"js:$(this).attr('href')",
              'success'=>'js:function(data){
              $.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
              data: $(this).serialize()});
              $.fn.yiiGridView.update("cpersonalia-overtime-grid", {
              data: $(this).serialize()});
              }',
              ),
              'class'=>'btn btn-mini btn-success',
              'style'=>'margin-left:10px;',
              ),
              'visible'=>'$data->daystatus1_id ==null',
              ), */
            ),
        ),
        array(
            'header' => 'Permission',
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gAttendance/deleteAttendance",array("id"=>$data->id))',
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
                        . CHtml::tag('div', array(), isset($data->permission1) ? $data->permission1->name . ". " . $data->remark : "")
                        . CHtml::tag('div', array(), isset($data->permission2) ? $data->permission2->name : "")
                        . CHtml::tag('div', array(), isset($data->permission3) ? $data->permission3->name : "")
                        . CHtml::tag('div', array(), isset($data->syncPermission) ? "#P# " . $data->syncPermission->permission_reason : "");
            }
        ),
        //'remark',
        array(
            'class' => 'TbButtonColumn',
            //'template'=>'{sakit}{alpha}{tad}{tap}{ok}{clear}',
            'template' => '{clear}',
            'buttons' => array(
                'clear' => array(
                    'label' => 'Clear',
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/alpha.png',
                    'url' => 'Yii::app()->createUrl("/m1/gAttendance/setClear", array("id"=>$data->id))',
                    'options' => array(
                        'ajax' => array(
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){
								$.fn.yiiGridView.update("cpersonalia-Attendance-grid", {
								data: $(this).serialize()});
							}',
                        ),
                        'class' => 'btn btn-mini btn-inverse',
                        'style' => 'margin-left:3px;',
                    ),
                    'visible' => '$data->realpattern_id !=90',
                ),
            ),
        ),
    ),
));
?>

<?php

$this->renderPartial('_formAttendance', array('model' => $modelAttendance));

