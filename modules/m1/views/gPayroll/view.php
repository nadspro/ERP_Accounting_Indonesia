<?php
/* @var $this GPayrollController */
/* @var $model gPayroll */

$this->breadcrumbs = array(
    'G Payrolls' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gPayroll')),
);
?>

<div class="page-header">
    <h1><?php echo $model->employee_name; ?></h1>
</div>

<?php
$this->widget('TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'label' => 'Basic Salary',
            'value' => Yii::app()->indoFormat->number($model->mBasicSalary),
        ),
        array(
            'label' => 'Total Benefit',
            'value' => Yii::app()->indoFormat->number($model->benefitC),
        ),
        array(
            'label' => 'Total Deduction',
            'value' => Yii::app()->indoFormat->number($model->deductionC),
        ),
    ),
));
?>

<div class="row">
    <div class="span9">
        <?php
        $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => array(
                array('label' => 'Salary History', 'content' => $this->renderPartial("_tabSalary", array("model" => $model, "modelPayroll" => $modelPayroll), true), 'active' => true),
                array('label' => 'Benefit', 'content' => $this->renderPartial("_tabBenefit", array("model" => $model, "modelPayrollBenefit" => $modelPayrollBenefit), true)),
                array('label' => 'Deduction', 'content' => $this->renderPartial("_tabDeduction", array("model" => $model, "modelPayrollDeduction" => $modelPayrollDeduction), true)),
            ),
        ));
        ?>
    </div>
</div>
