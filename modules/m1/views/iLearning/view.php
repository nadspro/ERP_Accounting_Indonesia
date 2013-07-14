<?php
/* @var $this ILearningController */
/* @var $model iLearning */

$this->breadcrumbs = array(
    'I Learnings' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/m1/iLearning')),
);
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
        array('id' => 'tab1', 'label' => 'Schedule', 'content' => $this->renderPartial("_tabSchedule", array("model" => $model), true), 'active' => true),
        array('id' => 'tab5', 'label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", array("model" => $model), true)),
    ),
));