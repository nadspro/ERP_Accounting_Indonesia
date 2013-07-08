<?php
$this->breadcrumbs = array(
    'Selection',
);

$this->menu4 = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gSelection')),
);

$this->menu1 = array(
    array('label' => 'Periodic Report', 'icon' => 'print', 'url' => array('report')),
);

//$this->menu1=gSelection::getTopUpdated();
$this->menu2 = gSelection::getTopCreated();
$this->menu5 = array('Selection');
$this->menu7 = gSelection::getTopRecentSelection();
?>

<div class="pull-right">
    <?php
    $this->renderPartial('/gSelection/_search', array(
        'model' => $model,
    ));
    ?>
</div>

<div class="page-header">
    <h1>
        <i class="icon-fa-tasks"></i>
        Selection	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'pills', // 'tabs' or 'pills'
    'tabs' => array(
        array('id' => 'tab1', 'label' => 'New Entry', 'content' => $this->renderPartial("/gSelection/_recNewEntry", array(), true), 'active' => true),
        array('id' => 'tab2', 'label' => 'Invitation', 'items' => array(
                array('id' => 'tab2a', 'label' => 'Schedule', 'content' => $this->renderPartial("/gSelection/_recInvited", array(), true)),
                array('id' => 'tab2b', 'label' => 'Result', 'content' => $this->renderPartial("/gSelection/_recInvitedResult", array(), true)),
            )),
        array('id' => 'tab3', 'label' => 'Appointment', 'items' => array(
                array('id' => 'tab3a', 'label' => 'Today', 'content' => $this->renderPartial("/gSelection/_recAppointment", array(), true)),
                array('id' => 'tab3b', 'label' => 'Tomorrow', 'content' => $this->renderPartial("/gSelection/_recAppointment1", array(), true)),
                array('id' => 'tab3c', 'label' => 'Today + 2', 'content' => $this->renderPartial("/gSelection/_recAppointment2", array(), true)),
                array('id' => 'tab3d', 'label' => 'Today + 3', 'content' => $this->renderPartial("/gSelection/_recAppointment3", array(), true)),
            )),
        array('id' => 'tab4', 'label' => 'Psycho / Technical Tested', 'items' => array(
                array('id' => 'tab4a', 'label' => 'Schedule', 'content' => $this->renderPartial("/gSelection/_recPsikotestSchedule", array(), true)),
                array('id' => 'tab4b', 'label' => 'Result', 'content' => $this->renderPartial("/gSelection/_recPsikotestResult", array(), true)),
            )),
        array('id' => 'tab5', 'label' => 'HR Interviewed', 'content' => $this->renderPartial("/gSelection/_recInterviewHr", array(), true)),
        array('id' => 'tab6', 'label' => 'User Interviewed', 'content' => $this->renderPartial("/gSelection/_recInterviewUser", array(), true)),
        array('id' => 'tab7', 'label' => 'Final Result', 'content' => $this->renderPartial("/gSelection/_recFinal", array(), true)),
    ),
));

