<?php
/* @var $this GPayrollController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'G Payrolls',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gPayroll')),
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-suitcase"></i>
        Payroll
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Dash Board', 'url' => Yii::app()->createUrl('/m1/gPayroll')),
        array('label' => 'All Employee', 'url' => Yii::app()->createUrl('/m1/gPayroll/currentMonth'), 'active' => true),
    //array('label'=>'Comparison','url'=>Yii::app()->createUrl('/m1/gPayroll/previousMonth')),
    ),
));
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-person-grid',
    'dataProvider' => $dataProvider,
    //'filter'=>$model,
    //'template'=>'{items}',
    'htmlOptions' => array("style" => "padding-top:0px"),
    'columns' => array(
        //array(
        //	'type'=>'raw',
        //	'value'=>'$data->photoPath',
        //	'htmlOptions'=>array("width"=>"50px"),
        //),
        array(
            'header' => 'Name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data->id)))',
        ),
        array(
            'header' => 'Department',
            'value' => '$data->mDepartment()',
        ),
        array(
            'header' => 'Status',
            'value' => '$data->mStatus()',
        ),
        array(
            'header' => 'Basic Salary',
            'value' => 'Yii::app()->indoFormat->number($data->mBasicSalary)',
        ),
        array(
            'header' => 'Benefit',
            'value' => 'Yii::app()->indoFormat->number($data->benefitC)',
        ),
        array(
            'header' => 'Deduction',
            'value' => 'Yii::app()->indoFormat->number($data->deductionC)',
        ),
        'remark',
    ),
));

