<?php
$this->breadcrumbs = array(
    'Cash and Bank' => array('index'),
    $model->system_ref,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/mCashbank')),
    array('label' => 'Update', 'icon' => 'edit', 'url' => array('update', 'id' => $model->id),'visible'=>in_array($model->state_id,array(1,2))),
    array('label' => 'Delete', 'icon' => 'remove', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?'), 'visible' => in_array($model->state_id,array(1,2))),
    array('label' => 'Print', 'icon' => 'print', 'url' => array('print', 'id' => $model->id)),
);

$this->menu1 = tJournal::getTopUpdated(2);
$this->menu2 = tJournal::getTopCreated(2);
//$this->menu3=tJournal::getTopRelated($model->user_ref);
$this->menu5 = array('Journal');
?>

<div class="page-header">
    <h1>
        <?php echo $model->system_reff; ?>
    </h1>
</div>

<p>
    <?php echo $model->remark; ?>
</p>

<?php
//$this->widget('bootstrap.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', array(
    'ItemColumns' => 2,
    'data' => $model,
    'attributes' => array(
        'input_date',
        'yearmonth_periode',
        array(
        	'label'=>'Receiver',
        	'name'=>'cb_custom1',
        	'visible'=>$model->journal_type_id == 2,
        ),
        array(
        	'label'=>'Received From',
        	'name'=>'cb_custom1',
        	'visible'=>$model->journal_type_id == 1,
        ),
    //'remark',
    ),
));
?>

<?php echo $this->renderPartial('/tJournal/_viewDetail', array('data' => $model)); ?>


<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-reorder"></i>Related Journal</li>
    </ul>
</div>

<?php
if (empty($_GET['asDialog'])) {
    //$this->widget('bootstrap.widgets.TbGridView', array(
    $this->widget('ext.groupgridview.GroupGridView', array(
        'id' => 'related-grid',
        'dataProvider' => $dataProvider,
        'template' => '{items}',
        'itemsCssClass' => 'table table-striped table-bordered',
        'mergeColumns' => array('input_date'),
        'enableSorting' => false,
        'columns' => array(
            'input_date',
            //'yearmonth_periode',
            //'user_ref',
            array(
                'header' => 'No Ref',
                'type' => 'raw',
                'value' => 'CHtml::link($data->system_ref,Yii::app()->createUrl("/m2/mCashbank/view",array("id"=>$data->id)))',
            ),
            'remark',
            array(
                'header' => 'Total',
                'value' => 'Yii::app()->indoFormat->number($data->journalSum)',
                'htmlOptions' => array(
                    'style' => 'text-align: right; padding-right: 5px;'
                ),
            ),
        ),
    ));
}
?>
