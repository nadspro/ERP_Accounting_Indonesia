<?php
$this->widget('TbGridView', array(
    'id' => 'g-param-level-grid',
    'dataProvider' => gParamLevel::model()->search(),
    //'filter'=>$model,
    'columns' => array(
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'sort',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(
                'url' => $this->createUrl('/m1/gHrParameter/updateParamLevelAjax'),
                'placement' => 'right',
                'inputclass' => 'span3',
            )
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'name',
            'value' => '($data->parent_id ==0) ? $data->name : "-- ".$data->name',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(
                'url' => $this->createUrl('/m1/gHrParameter/updateParamLevelAjax'),
                'placement' => 'right',
                'inputclass' => 'span3',
            )
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'golongan',
            //'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(
                'url' => $this->createUrl('/m1/gHrParameter/updateParamLevelAjax'),
                'placement' => 'right',
                'inputclass' => 'span3',
            ),
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m1/gHrParameter/deleteParamLevel",array("id"=>$data->id))',
        ),
    ),
));
?>

<div class="page-header">
    <h3>New Param Level</h3>
</div>

<?php
echo $this->renderPartial('_formParamLevel', array('model' => $model));