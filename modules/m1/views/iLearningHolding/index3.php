<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'I Learnings',
);

$this->menu = array(
    array('label' => 'Learning Calendar', 'icon' => 'briefcase', 'url' => array('/m1/iLearningHolding')),
    array('label' => 'List By Subject', 'icon' => 'briefcase', 'url' => array('/m1/iLearningHolding/index2')),
);


$this->menu5 = array('Sylabus');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-book"></i>
        Learning List by Date
    </h1>
</div>


<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'id' => 'tabs',
    'tabs' => array(
        array('id' => 'tab1', 'label' => 'Upcoming Event', 'content' => $this->renderPartial("_tabEventComing", array(), true), 'active' => true),
        array('id' => 'tab2', 'label' => 'Past Event', 'content' => $this->renderPartial("_tabEventPast", array(), true)),
    ),
));

