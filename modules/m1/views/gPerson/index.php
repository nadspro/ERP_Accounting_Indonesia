<?php
$this->breadcrumbs = array(
    'Person',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gPerson')),
    array('label' => 'List of Uncomplete Data', 'icon' => 'th-list', 'url' => array('/m1/default/uncomplete')),
    array('label' => 'Birthday of the Month', 'icon' => 'th-list', 'url' => array('/m1/default/birthday')),
    array('label' => 'Probation / Contract', 'icon' => 'th-list', 'url' => array('/m1/default/probationcontract')),
    array('label' => 'Employee In / Out', 'icon' => 'th-list', 'url' => array('/m1/default/employeeinout')),
    array('label' => 'Black List', 'icon' => 'th-list', 'url' => array('/m1/default/blacklist')),
);

$this->menu1 = gPerson::getTopUpdatedCareer();
$this->menu2 = gPerson::getTopCreated();
//$this->menu4=gPerson::getTopOther();  //uncomplete data
$this->menu5 = array('Person');

//$this->menu7=array(
//		array('label'=>'All','icon'=>'list','url'=>array('/m1/gPerson')),
//		array('label'=>'Sample Dept','icon'=>'list','url'=>'#'),
//);

$this->menu7 = aOrganization::compDeptPersonFilter();

$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gPerson/index'));
?>


<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        Employee Data
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

