<?php
$this->breadcrumbs = array(
    'Person',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/kPayroll')),
);

$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();


$this->menu7 = aOrganization::compDeptPayrollFilter();

$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gPersonCostcenter/index'));
?>


<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        Cost Center
    </h1>
</div>

<?php
if (isset($_GET['pid'])) {
    if ((int) $_GET['pid'] != 0) {
        echo "<b><p style='display: block;margin: 5px 0;padding: 10px;background-color: #EAEFFF;'>";
        echo "Filter By Directorate/Department: " . aOrganization::model()->findByPk((int) $_GET['pid'])->name;
        echo "</p></b>";
    }
}
?>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    //$this->widget('ext.EColumnListView', array(
    //'span' => 3,
    //'columns'=>2,
    'dataProvider' => $dataProvider,
    'template' => '{items}{pager}',
    'itemView' => '/gPerson/_view',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    )
));
?>

