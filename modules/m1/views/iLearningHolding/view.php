<?php
/* @var $this ILearningController */
/* @var $model iLearning */

$this->breadcrumbs = array(
    'I Learnings' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/iLearningHolding')),
    array('label' => 'Update', 'icon' => 'pencil', 'url' => array('/m1/iLearningHolding/update', 'id' => $model->id)),
    array('label' => 'Delete', 'icon' => 'remove', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);

$this->menu1 = iLearning::getTopUpdated();
$this->menu2 = iLearning::getTopCreated();
$this->menu5 = array('Sylabus');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-book"></i>
        <?php echo $model->learning_title; ?>
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'id' => 'tabs',
    'tabs' => array(
        array('id' => 'tab1', 'label' => 'Upcoming Event', 'content' => $this->renderPartial("_tabEventComingById", array("model" => $model, 'type' => $model->type_id), true), 'active' => true),
        array('id' => 'tab2', 'label' => 'Past Event', 'content' => $this->renderPartial("_tabEventPastById", array("model" => $model), true)),
        array('id' => 'tab5', 'label' => 'Detail', 'content' => $this->renderPartial("/iLearning/_tabDetail", array("model" => $model), true)),
    ),
));
?>

<div class="page-header">
    <h3>New Schedule</h3>
</div>

<?php
echo $this->renderPartial('_formSchedule', array('type' => $model->type_id, 'model' => $modelSchedule));

