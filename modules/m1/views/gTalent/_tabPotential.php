<?php
echo $this->renderPartial("_summaryPotential", array("model" => $model), true);
?>
<br/>

<?php
$this->widget('TbGridView', array(
    'id' => 'g-person-potential-grid',
    'dataProvider' => gTalentPotential::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        'input_date',
        'year',
        'amount',
        //'qualification',
        array(
            'header' => 'Potential Value',
            'value' => '$data->valPotential()',
        ),
        'remark',
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gTalent/deletePotential",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'm1/gTalent/updatePotential',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Potential',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    ),
));
?>

<div class="page-header">
    <h3>New Potential</h3>
</div>
<?php
echo $this->renderPartial('_formPotential', array('model' => $modelPotential));
