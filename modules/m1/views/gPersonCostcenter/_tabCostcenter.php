<?php
$this->widget('TbGridView', array(
    'id' => 'g-person-costcenter-grid',
    'dataProvider' => gPersonCostcenter::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        'start_date',
        'end_date',
        array(
            'header' => 'Company',
            'value' => 'isset($data->company->name) ? $data->company->name : ""',
        ),
        'remark',
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteCostcenter",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'm1/gPerson/updateCostcenter',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Cost Center',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
            'visible' => ($this->id == "gPerson")
        ),
    ),
));
?>

<div class="page-header">
    <h3>New Cost Center</h3>
</div>
<?php
echo $this->renderPartial('_formCostcenter', array('model' => $modelCostcenter));

