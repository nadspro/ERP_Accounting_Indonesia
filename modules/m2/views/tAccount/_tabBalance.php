<h3>Balance Sheet</h3>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'t-account-balance-sum-grid',
	'dataProvider'=>tBalanceSheet::model()->search($model->id),
	'template'=>'{items}{pager}',
	'itemsCssClass'=>'table table-striped table-bordered',
	'columns'=>array(
		array(
				'name'=>'type_balance_id',
				'value'=>'sParameter::item("cBalanceType",$data->type_balance_id)',
		),
		'yearmonth_periode',
		//array(
		//	'name'=>'budget',
		//	'htmlOptions'=>array(
		//		'style'=>'text-align: right; padding-right: 5px;'
		//	),
		//),
		array(
				'name'=>'beginning_balance',
				'value'=>'Yii::app()->indoFormat->number($data->beginning_balance)',
				'htmlOptions'=>array(
						'style'=>'text-align: right; padding-right: 5px;'
				),
		),
		array(
				'name'=>'debit',
				'value'=>'Yii::app()->indoFormat->number($data->debit)',
				'htmlOptions'=>array(
						'style'=>'text-align: right; padding-right: 5px;'
				),
		),
		array(
				'name'=>'credit',
				'value'=>'Yii::app()->indoFormat->number($data->credit)',
				'htmlOptions'=>array(
						'style'=>'text-align: right; padding-right: 5px;'
				),
		),
		array(
				'name'=>'end_balance',
				'value'=>'Yii::app()->indoFormat->number($data->end_balance)',
				'htmlOptions'=>array(
						'style'=>'text-align: right; padding-right: 5px;'
				),
		),
	),
)); ?>

<br>

<h3>Last 20 Journal List</h3>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
//$this->widget('ext.groupgridview.GroupGridView', array(
	//		'mergeColumns' => array('journal.input_date'),
	'id'=>'t-account-balance-grid',
	'dataProvider'=>uJournalDetail::model()->searchByAccount($model->id),
	'template'=>'{items}',
	'itemsCssClass'=>'table table-striped table-bordered',
	'columns'=>array(
		array(
				'header'=>'Tanggal',
				'name'=>'journal.input_date',
				'value'=>'$data->journal->input_date',
		),
		array(
				'header'=>'Entity',
				'value'=>'$data->journal->entity->branch_code',
		),
		array(
				'header'=>'No Ref',
				'value'=>'$data->journal->system_reff()',
		),
		array(
				'name'=>'debit',
				'value'=>'Yii::app()->indoFormat->number($data->debit)',
				'htmlOptions'=>array(
						'style'=>'text-align: right; padding-right: 5px;'
				),
		),
		array(
				'name'=>'credit',
				'value'=>'Yii::app()->indoFormat->number($data->credit)',
				'htmlOptions'=>array(
						'style'=>'text-align: right; padding-right: 5px;'
				),
		),
		'user_remark',
	),
));
?>

<br />

