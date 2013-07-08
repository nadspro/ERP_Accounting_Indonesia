<?php
/* @var $this JSelectionController */
/* @var $model jSelection */

$this->breadcrumbs = array(
    'J Selections' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/jSelectionHolding')),
    array('label' => 'Update', 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete', 'icon' => 'remove', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-tasks"></i>
        <?php echo $model->category->name; ?></h1>
</div>

<?php
$this->widget('TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'pic',
        array(
            'label' => 'Category',
            'name' => 'category.name',
        ),
        'schedule_date',
        'additional_info',
        //'cost',
        array(
            'label' => 'Status',
            'name' => 'status.name',
        ),
    ),
));
?>




<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'id' => 'tabs',
    'tabs' => array(
        array('id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabViewDetail", array("model" => $model), true), 'active' => true),
        array('id' => 'tab2', 'label' => 'Assestment', 'content' => $this->renderPartial("_tabViewAssestment", array("model" => $model), true)),
    ),
));
?>

<div class="page-header">
    <h3>New Participant</h3>
</div>

<?php
echo $this->renderPartial('_formParticipant', array('model' => $modelParticipant));

