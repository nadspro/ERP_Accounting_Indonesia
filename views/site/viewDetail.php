<?php
$this->breadcrumbs = array(
    'Learning Schedule' => array('index'),
        //$model->id,
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/m1/iLearning')),
    array('label' => $model->getparent->learning_title, 'url' => array('/m1/iLearning/view', 'id' => $model->parent_id)),
);
?>

<h1>
    <i class="icon-fa-book"></i>
    <?php echo $model->getparent->learning_title; ?></h1>
<h3><?php echo $model->schedule_date ?></h3>

<?php
$this->widget('ext.bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'getparent.objective',
        'getparent.outline',
        'getparent.participant',
        'getparent.duration',
        array(
            'name' => 'getparent.type_id',
            'value' => $model->getparent->type->name,
        ),
    ),
));
?>
<br/>

<?php
$this->widget('ext.bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'trainer_name',
        'location',
        'schedule_date',
        'additional_info',
        array(
            'name' => 'status_id',
            'value' => $model->status->name,
        ),
    ),
));
?>

