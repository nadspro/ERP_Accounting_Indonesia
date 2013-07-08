<?php
$this->widget('TbGridView', array(
    'id' => 'g-payroll-deduction-grid',
    'dataProvider' => gPayrollDeduction::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'htmlOptions' => array("style" => "padding-top:0px"),
    'columns' => array(
        'deduction_id',
        'yearmonth_start',
        'yearmonth_end',
        'amount',
        'remark',
    //array(
    //	'class'=>'CButtonColumn',
    //),
    ),
));
?>

<h4>New Deduction</h4>

<?php
echo $this->renderPartial('_formDeduction', array('model' => $modelPayrollDeduction));

