<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>

<div class="page-header">
    <h1>
        <h1><i class="icon-fa-book"></i>
            <?php
            echo $model->getparent->learning_title . " (" . $model->partCount . ") | "
            . $model->schedule_date
            ?></h1>
    </h1>
</div>

<br/>

<?php
$this->widget('ext.bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'getparent.learning_title',
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
        'partCount',
    ),
));


