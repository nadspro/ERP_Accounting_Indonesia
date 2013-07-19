<style>
    tr.highlight
    {
        background: #EAEFFF;
        font-weight:bold;
    }
    tr.white
    {
        background: #FFFFFF;
    }
</style>

<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>


<div class="page-header">
    <h1>
        <i class="icon-fa-plane"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<div class="row">
    <div class="span8">

        <?php
        echo $this->renderPartial("/gLeave/_LeaveBalance", array("model" => $model), true);
        ?>
    </div>
</div>

<div class="row">
    <div class="span9">
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            //$this->widget('ext.groupgridview.GroupGridView', array(
            //'extraRowColumns' => array('d_cuti'),
            'id' => 'g-person-grid',
            'dataProvider' => gLeave::model()->search($model->id),
            //'filter'=>$model,
            'template' => '{items}',
            'rowCssClassExpression' => '$data->cssReason()',
            'columns' => array(
                array(
                    'name' => 'start_date',
                    'htmlOptions' => array(
                        'style' => 'width:85px',
                    )
                ),
                array(
                    'name' => 'end_date',
                    'htmlOptions' => array(
                        'style' => 'width:85px',
                    )
                ),
                'number_of_day',
                //'work_date',
                array(
                    'name' => 'leave_reason',
                    'htmlOptions' => array(
                    //'style'=>'width:250px',
                    )
                ),
                //'leave_reason',
                'mass_leave',
                'person_leave',
                'balance',
                //'replacement',
                array(
                    'header' => 'State',
                    'value' => '$data->approved->name',
                    'htmlOptions' => array(
                        'style' => 'width:150px',
                    )
                ),
                array(
                    'class' => 'TbButtonColumn',
                    'template' => '{mydelete}',
                    'buttons' => array
                        (
                        'mydelete' => array
                            (
                            'label' => 'Delete',
                            //'icon'=>'icon-delete',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/deleteLeave",array("id"=>$data->id))',
                            'visible' => '$data->balance == null && strtotime($data->start_date) > time()',
                            'options' => array(
                                'class' => 'btn btn-mini',
                            ),
                        ),
                    ),
                ),
                array(
                    'class' => 'TbButtonColumn',
                    'template' => '{cupdate}{cupdatecancel}',
                    'buttons' => array
                        (
                        'cupdate' => array
                            (
                            'label' => 'Update',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/updateLeave",array("id"=>$data->id))',
                            'visible' => '$data->approved_id ==1 && strtotime($data->start_date) > time()',
                            'options' => array(
                                'class' => 'btn btn-mini',
                            ),
                        ),
                        'cupdatecancel' => array
                            (
                            'label' => 'Update',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/updateCancellationLeave",array("id"=>$data->id))',
                            'visible' => '$data->approved_id ==8 && $data->balance ==null && strtotime($data->start_date) > time()',
                            'options' => array(
                                'class' => 'btn btn-mini',
                            ),
                        ),
                    ),
                ),
                array(
                    'class' => 'TbButtonColumn',
                    'template' => '{print}{printcancel}',
                    'buttons' => array
                        (
                        'print' => array
                            (
                            'label' => 'Print',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/printLeave",array("id"=>$data->id))',
                            'visible' => '$data->approved_id ==1',
                            'options' => array(
                                'class' => 'btn btn-mini',
                                'target' => '_blank',
                            ),
                        ),
                        'printcancel' => array
                            (
                            'label' => 'Print',
                            'url' => 'Yii::app()->createUrl("/m1/gEss/printCancellationLeave",array("id"=>$data->id))',
                            'visible' => '$data->approved_id ==8 AND $data->balance ==null',
                            'options' => array(
                                'class' => 'btn btn-mini',
                                'target' => '_blank',
                            ),
                        ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>