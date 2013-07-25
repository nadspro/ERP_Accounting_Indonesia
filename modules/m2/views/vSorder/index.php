<?php
$this->breadcrumbs = array(
    'Sales Order',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/vSorder')),
);

//$this->menu1=vSorder::getTopUpdated(1);
//$this->menu2=vSorder::getTopCreated(1);
$this->menu5 = array('SO');
?>

<div class="page-header">
    <h1>
        Sales Order:
        <?php
        if ($id == 1)
            echo "UnApproved"; elseif ($id == 2)
            echo "Unpaid/Partial Paid";
        else
            "Paid";
        ?>
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'UnApproved', 'url' => Yii::app()->createUrl('/m2/vSorder', array("id" => 1)), 'active' => ($id == 1)),
        array('label' => 'UnPaid/Partial Paid', 'url' => Yii::app()->createUrl('/m2/vSorder', array("id" => 2)), 'active' => ($id == 2)),
        array('label' => 'Paid', 'url' => Yii::app()->createUrl('/m2/vSorder', array("id" => 3)), 'active' => ($id == 3)),
        array('label' => 'Show All', 'url' => Yii::app()->createUrl('/m2/vSorder', array("id" => 0)), 'active' => ($id == 0)),
    ),
));
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'vSorderInventory-grid',
    'dataProvider' => vSorder::model()->search($id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'Entity',
            'value' => '$data->organization->name',
        ),
        array(
            'header' => 'Supplier',
            'type' => 'raw',
            'value' => 'CHtml::link($data->supplier->company_name,Yii::app()->createUrl("/m2/uCustomer/view",array("id"=>$data->customer_id)))',
        ),
        'input_date',
        array(
            'header' => 'System Ref',
            'type' => 'raw',
            'value' => 'CHtml::link($data->system_ref,Yii::app()->createUrl("/m2/vSorder/view",array("id"=>$data->id)))',
        ),
        //'system_ref',
        //'periode_date',
        //array(
        //	'header'=>'PO Type',
        //	'value'=>'$data->po_type_id',
        //),
        //'remark',
        array(
            'header' => 'Total',
            'value' => 'Yii::app()->indoFormat->number($data->sum_so)',
            'htmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px;'
            ),
        ),
        //array(
        //	'class'=>'ext.gridcolumns.RunningTotalColumn',
        //	'value'=>'$data->sum_po',
        //	'output'=>'Yii::app()->indoFormat->number($total)',
        //	'type'=>'raw',
        //	'htmlOptions'=>array(
        //			'style'=>'text-align: right; padding-right: 5px;'
        //	),
        //),
        array(
            'class' => 'TbButtonColumn',
            'template' => '{myUpdate}{myView}{myDelete}',
            'buttons' => array
                (
                'myUpdate' => array
                    (
                    'label' => '<i class="icon-pencil"></i>',
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/update.png',
                    'url' => '$this->grid->controller->createUrl("/m2/vSorderInventory/update", array("id"=>$data->id))',
                    'visible' => '!isset($data->approved_date)',
                ),
                'myView' => array
                    (
                    'label' => '<i class="icon-zoom-in"></i>',
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/detail.png',
                    'url' => '$this->grid->controller->createUrl("/m2/vSorderInventory/view", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open"); return false;}',
                ),
                'myDelete' => array
                    (
                    'label' => '<i class="icon-remove"></i>',
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/delete.png',
                    'url' => '$this->grid->controller->createUrl("/m2/vSorderInventory/delete", array("id"=>$data->id))',
                    'visible' => '!isset($data->approved_date)',
                    'options' => array(
                    /* 	'ajax'=>array(
                      'type'=>'POST',
                      'url'=>"js:$(this).attr('href')",
                      'success'=>'js:function(data){
                      $.fn.yiiGridView.update("vSorderInventory-grid", {
                      data: $(this).serialize()
                      });
                      }',
                      ), */
                    ),
                ),
            ),
        ),
        'approved_date',
        array(
            'header' => 'Payment Status',
            'value' => '$data->paymentCheck()',
        ),
    //array(
    //		'header'=>'Aging',
    //		'value'=>'Yii::app()->dateFormatter->format("yyyy-MM-dd",time())',
    //		//'value'=>'CDateTimeParser::parse(time(),"yyyy/MM/dd")',
    //)
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
<iframe id="cru-frame" width="100%" height="100%"></iframe>
<?php
$this->endWidget();
//--------------------- end new code --------------------------
?><?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog',
    'options' => array(
        'title' => 'Payment Process',
        'autoOpen' => false,
        'modal' => true,
    ),
));
echo 'Posting Complete...';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

