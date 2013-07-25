<?php
$this->breadcrumbs = array(
    'Journal Voucher' => array('index'),
    $model->system_ref,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/tJournal/')),
    array('label' => 'Update', 'icon' => 'edit', 'url' => array('update', 'id' => $model->id), 'visible' => $model->state_id != 4),
    array('label' => 'Delete', 'icon' => 'remove', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?'), 'visible' => $model->state_id != 4),
    array('label' => 'Print', 'icon' => 'print', 'url' => array('print', 'id' => $model->id)),
);

$this->menu1 = tJournal::getTopUpdated(1);
$this->menu2 = tJournal::getTopCreated(1);
//$this->menu3=tJournal::getTopRelated($model->user_ref);
$this->menu5 = array('Journal');
?>

<div class="page-header">
    <h1>
        <?php echo $model->system_reff; ?>
    </h1>
</div>

<?php
//$this->widget('bootstrap.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', array(
    'ItemColumns' => 2,
    'data' => $model,
    'attributes' => array(
        'input_date',
        'yearmonth_periode',
        array(
            'label' => 'Module',
            'value' => $model->module->name,
        ),
        'user_ref',
        array(
            'label' => 'Total',
            'value' => Yii::app()->indoFormat->number($model->journalSum),
        ),
        'remark',
    //'journal_type_id',
    ),
));
?>

<?php echo $this->renderPartial('/tJournal/_viewDetail', array('data' => $model)); ?>

