<?php
$this->breadcrumbs = array(
    'Account',
);

$this->menu = array(
);

//$this->widget('ext.loading.LoadingWidget');
?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'wait',
    'options' => array(
        'title' => 'Closing on Progress',
        'autoOpen' => false,
        'modal' => true,
    ),
));
echo 'Please Wait...';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog',
    'options' => array(
        'title' => 'Closing Month Process',
        'autoOpen' => false,
        'modal' => true,
        'buttons' => array(
            'OK' => 'js:function(){$(this).dialog("close");}',
        ),
    ),
));
echo 'Process Complete...';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php
Yii::app()->clientScript->registerScript('myCap', "

		$('#myCap').click(function(){
		$.ajax({
		type : 'get',
		url  : $(this).attr('href'),
		data: '',
		success : function(r){
		$('#mydialog').dialog('open');
		//Loading.hide();

}
})
		return false;
});


		");
?>


<div class="page-header">
    <h1>
        Closing Month and Year Period
    </h1>
</div>

<?php
//Yii::app()->settings->set("System", "cCurrentPeriod", 201306, $toDatabase=true);
?>
<?php
//echo tAccount::labarugiDitahan(201202);
//echo "<br/>";
//echo tAccount::netprofit(201202);
//echo "<br/>";
//$modelBalanceCurrent=tBalanceSheet::model()->find(array('condition'=>'parent_id = 124 AND yearmonth_periode = 201201'));
//echo $modelBalanceCurrent->beginning_balance;
?>

<div class="row">
    <div class="span12">
        <h2>
            Current Period:
            <?php echo Yii::app()->settings->get("System", "cCurrentPeriod"); ?>

        </h2>
    </div>
</div>

<div class="row">
    <div class="span12">
        <p>When Button "Closing Month Period" executed, it will do this 3
            following steps.</p>
        <p>#1. It will check, of any unposted journal on Current Period, will
            marked as Locked</p>
        <p>#2. It will move each End-Balance Account on Current Month Period
            and transfer into following Month Period.</p>
        <p>#3. Change Current Period into following Month Period. When this
            process done, all existing journal become unavailable to edit and
            delete</p>
    </div>
</div>

<p>
    <?php
    $this->widget('zii.widgets.jui.CJuiButton', array(
        'buttonType' => 'link',
        'id' => 'myCap',
        'name' => 'btnGo7',
        'url' => Yii::app()->createUrl("/m2/tClosing/closingPeriodExecution"),
        'caption' => 'Closing Month Period',
        'options' => array(
        //'icons'=>'js:{secondary:"ui-icon-extlink"}',
        //'onclick'=>'js:{Loading.show();}',
        ),
        'htmlOptions' => array(
            'class' => 'ui-button-primary',
        ),
    ));
    ?>
</p>


<h2>Unposted Journal</h2>
<?php
//$this->widget('bootstrap.widgets.TbGridView', array(
$this->widget('ext.groupgridview.GroupGridView', array(
    'mergeColumns' => array('input_date'),
    'id' => 'u-journal-grid',
    'dataProvider' => tJournal::model()->search(),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/m2/tPosting/delete",array("id"=>$data->id))',
        //'template'=>'{delete}{process}',
        /* 			'buttons'=>array
          (
          'process' => array
          (
          //'label'=>'<i class="icon-zoom-in"></i>',
          //'imageUrl'=>Yii::app()->request->baseUrl.'/css/process.png',
          'url'=>'Yii::app()->createUrl("sUser/updatep", array("id"=>$data->id))',
          ),
          ),
         */        ),
        'input_date',
        'system_ref',
        array(
            'header' => 'Module',
            'value' => 'sParameter::item("cModule",$data->module_id)',
        ),
        //'remark',
        //array (
        //	'header'=>'Total item',
        //	'value'=>'$data->journalCount',
        //	'htmlOptions'=>array(
        //		'style'=>'text-align: right; padding-right: 5px;'
        //	),
        //),
        array(
            'header' => 'Status',
            'value' => '$data->status->name',
        ),
        array(
            'header' => 'Total',
            'type' => 'number',
            'value' => '$data->journalSum',
            'htmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px;'
            ),
        ),
    ),
));

//$_nextPeriod = sParameter::cBeginDateAfter(Yii::app()->settings->get("System", "cCurrentPeriod"));
//Yii::app()->settings->set("System", "cCurrentPeriod", $_nextPeriod, $toDatabase=true);
?>
