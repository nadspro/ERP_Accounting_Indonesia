<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'uSupplierap-grid',
    'dataProvider' => vPorder::model()->searchSupplier($model->id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'Entity',
            'value' => '$data->organization->name',
        ),
        'input_date',
        array(
            'header' => 'System Ref',
            'type' => 'raw',
            'value' => 'CHtml::link($data->system_ref,Yii::app()->createUrl("/m2/mAccpayable/view",array("id"=>$data->id)))',
        ),
        //'periode_date',
        //'remark',
        array(
            'header' => 'Total',
            'value' => 'Yii::app()->indoFormat->number($data->sum_po)',
            'htmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px;'
            ),
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{myView}',
            'buttons' => array
                (
                'myView' => array
                    (
                    'label' => '<i class="icon-zoom-in"></i>',
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/detail.png',
                    'url' => '$this->grid->controller->createUrl("/m2/viewSupplierDetail", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open"); return false;}',
                ),
            ),
        ),
        'approved_date',
        array(
            'header' => 'Payment',
            'value' => '$data->payment',
            'htmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px;'
            ),
        ),
        array(
            'header' => 'Payment Status',
            'value' => '$data->paymentCheck()',
        )
    ),
));
?>

<br />
<?php
//$this->widget('bootstrap.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', array(
    'ItemColumns' => 3,
    'data' => array(
        'id' => 1,
        'countPO' => vPorder::model()->count("supplier_id = " . $model->id),
        'unApproved' => vPorder::model()->count("approved_date is null AND supplier_id = " . $model->id),
        'unPaid' => vPorder::model()->count("approved_date is not null AND payment_state_id = 1 AND supplier_id = " . $model->id),
        'paid' => vPorder::model()->count("payment_state_id = 2 AND supplier_id = " . $model->id),
        'amountPO' => vPorder::model()->hutangPerSupplier($model->id),
        'payment' => vPorder::model()->paymentPerSupplier($model->id),
        'balance' => vPorder::model()->balancePerSupplier($model->id),
    ),
    'attributes' => array(
        array(
            'label' => 'Total Count PO',
            'name' => 'countPO',
        ),
        null,
        null,
        array(
            'label' => 'UnApproved',
            'name' => 'unApproved',
        ),
        array(
            'label' => 'Unpaid',
            'name' => 'unPaid',
        ),
        array(
            'label' => 'Paid',
            'name' => 'paid',
        ),
        array(
            'label' => 'Total Amount PO',
            'name' => 'amountPO',
        ),
        array(
            'label' => 'Total Payment',
            'name' => 'payment',
        ),
        null,
        array(
            'label' => 'Balance',
            'name' => 'balance',
        ),
    ),
));
?>


<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'cru-dialog',
    'options' => array(
        'title' => 'View Detail',
        'autoOpen' => false,
        'modal' => true,
        'width' => '70%',
        'height' => '550',
    ),
));
?>
<iframe id="cru-frame" width="100%"
        height="100%"></iframe>
<?php
$this->endWidget();
//--------------------- end new code --------------------------
?>
