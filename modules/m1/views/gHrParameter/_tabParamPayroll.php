<?php
$this->widget('TbGridView', array(
    'id' => 'g-param-permission-grid',
    'dataProvider' => gParamPayroll::model()->search(),
    //'filter'=>$model,
    'columns' => array(
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'sort',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(
                'url' => $this->createUrl('/m1/gHrParameter/updateParamPayrollAjax'),
                'placement' => 'right',
                'inputclass' => 'span3',
            )
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'name',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(
                'url' => $this->createUrl('/m1/gHrParameter/updateParamPayrollAjax'),
                'placement' => 'right',
                'inputclass' => 'span3',
            )
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'amount',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(
                'url' => $this->createUrl('/m1/gHrParameter/updateParamPayrollAjax'),
                'placement' => 'right',
                'inputclass' => 'span3',
            )
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gHrParameter/deleteParamPayroll",array("id"=>$data->id))',
        ),
    ),
));
?>

<div class="page-header">
    <h3>New Param Payroll</h3>
</div>

<?php
echo $this->renderPartial('_formParamPayroll', array('model' => $model));
