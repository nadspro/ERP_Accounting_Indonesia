<?php
$this->widget('TbGridView', array(
    'id' => 'g-payroll-benefit-grid',
    'dataProvider' => gPayroll::model()->search($model->id),
    'template' => '{items}',
    'htmlOptions' => array("style" => "padding-top:0px"),
    'columns' => array(
        'yearmonth_start',
        array(
            'name' => 'category.name',
            'header' => 'Catagory',
        ),
        'basic_salary',
        'remark',
    //array(
    //	'class'=>'CButtonColumn',
    //),
    ),
));
?>


<h4>New Payroll</h4>

<?php
echo $this->renderPartial('_formPayroll', array('model' => $modelPayroll));
