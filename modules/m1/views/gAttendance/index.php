<?php
$this->breadcrumbs = array(
    'G people',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gAttendance')),
    array('label' => 'Schedule Upload', 'icon' => 'calendar', 'url' => array('timeBlock')),
    array('label' => 'Attendant Upload', 'icon' => 'user', 'url' => array('attendBlock')),
    array('label' => 'Parameter Time Block', 'icon' => 'wrench', 'url' => array('paramTimeblock')),
);

$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

$this->menu7 = aOrganization::compDeptPersonFilter();

$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gAttendance/index'));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-key"></i>
        Attendance
    </h1>
</div>


<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '/gPerson/_view',
));
