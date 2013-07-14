<?php
$this->breadcrumbs = array(
    'G people' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gAttendance')),
    array('label' => 'Schedule Upload', 'icon' => 'calendar', 'url' => array('timeBlock')),
    array('label' => 'Attendant Upload', 'icon' => 'user', 'url' => array('attendBlock')),
    array('label' => 'Schedule Applied', 'icon' => 'download-alt', 'url' => array('transferAttendance', 'id' => $model->id, 'month' => $month)),
    array('label' => 'Print', 'icon' => 'print', 'url' => array('/m1/gAttendance/printDetail', 'id' => $model->id, 'month' => $month)),
    array('label' => 'Link to Person', 'icon' => 'user', 'url' => array('/m1/gPerson/view', 'id' => $model->id)),
    array('label' => 'Link to Leave', 'icon' => 'plane', 'url' => array('/m1/gLeave/view', 'id' => $model->id)),
    array('label' => 'Link to Permission', 'icon' => 'hand-up', 'url' => array('/m1/gPermission/view', 'id' => $model->id)),
);


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();

$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gAttendance/index'));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-key"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>


<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => '<< Previous Month', 'url' => Yii::app()->createUrl("/m1/gAttendance/view", array("id" => $model->id, "month" => $month - 1))),
        array('label' => date("Ym", strtotime(date("Y-m", strtotime($month . " month")) . "-01")),
            'url' => Yii::app()->createUrl("/m1/gAttendance/view", array("id" => $model->id, "month" => $month))),
        array('label' => 'Next Month >>', 'url' => Yii::app()->createUrl("/m1/gAttendance/view", array("id" => $model->id, "month" => $month + 1))),
    ),
));
?>


<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => array(
        array('label' => 'Attendance', 'content' => $this->renderPartial("_tabAttendance", array("model" => $model, "modelAttendance" => $modelAttendance, "month" => $month), true), 'active' => true),
        array('label' => 'Over Time', 'content' => $this->renderPartial("_tabOvertime", array("model" => $model, "month" => $month), true)),
        array('label' => 'Leave / Permission', 'content' => $this->renderPartial("_tabLeavePermission", array("model" => $model, "modelAttendance" => $modelAttendance, "month" => $month), true)),
        array('label' => 'Detail', 'content' => $this->renderPartial("/gPerson/_personalInfo", array("model" => $model), true),),
    ),
));


