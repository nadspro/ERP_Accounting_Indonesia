<?php
/* @var $this GPayrollController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'G Payrolls',
);

$this->menu=array(
	//array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m1/gPayroll')),
);
?>

<div class="page-header">
	<h1>
		<i class="icon-fa-suitcase"></i>
		Payroll
	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'Dash Board','url'=>Yii::app()->createUrl('/m1/gPayroll'),'active'=>true),
				array('label'=>'All Employee','url'=>Yii::app()->createUrl('/m1/gPayroll/currentMonth')),
				//array('label'=>'Comparison','url'=>Yii::app()->createUrl('/m1/gPayroll/previousMonth')),

		),
));
?>

<h4 style="margin-top: -5px; padding: 8px; background-color:#E6E6E6">
Join New / Join Continued</h4>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'g-newemployee-grid',
	'dataProvider'=>gPerson::model()->newPayroll,
	//'filter'=>$model,
	'template'=>'{items}',
	'htmlOptions'=>array("style"=>"padding-top:0px"),
	'columns'=>array(
		//array(
		//	'type'=>'raw',
		//	'value'=>'$data->photoPath',
		//	'htmlOptions'=>array("width"=>"50px"),
		//),
		array(
			'header'=>'Name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data->id)))',
		),
		array(
			'header'=>'Department',
			'value'=>'$data->mDepartment()',
		),
		array(
			'header'=>'Join Date',
			'value'=>'$data->companyfirst->start_date',
		),
		array(
				'header'=>'Basic Salary',
				'value'=>'Yii::app()->indoFormat->number($data->mBasicSalary)',
		),
		array(
				'header'=>'Benefit',
				'value'=>'Yii::app()->indoFormat->number($data->benefitC)',
		),
		array(
				'header'=>'Deduction',
				'value'=>'Yii::app()->indoFormat->number($data->deductionC)',
		),
		'remark',
		array(
				'header'=>'Status',
				'type'=>'raw',
				'value'=>'(isset($data->payroll->id)) ? CHtml::tag("span",array("class"=>"label label-success"),"Process") : 
				CHtml::tag("span",array("class"=>"label label-warning"),"Unprocess") ',
		),
	),
)); 

?>

<br/>

<h4 style="margin-top: -5px; padding: 8px; background-color:#E6E6E6">
Mutation</h4>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'g-newemployee-grid',
	'dataProvider'=>gPerson::model()->newMutation,
	//'filter'=>$model,
	'template'=>'{items}',
	'htmlOptions'=>array("style"=>"padding-top:0px"),
	'columns'=>array(
		//array(
		//	'type'=>'raw',
		//	'value'=>'$data->photoPath',
		//	'htmlOptions'=>array("width"=>"50px"),
		//),
		array(
			'header'=>'Name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data->id)))',
		),
		array(
			'header'=>'Department',
			'value'=>'$data->mDepartment()',
		),
		array(
			'header'=>'Join Date',
			'value'=>'$data->companyfirst->start_date',
		),
		array(
				'header'=>'Basic Salary',
				'value'=>'Yii::app()->indoFormat->number($data->mBasicSalary)',
		),
		array(
				'header'=>'Benefit',
				'value'=>'Yii::app()->indoFormat->number($data->benefitC)',
		),
		array(
				'header'=>'Deduction',
				'value'=>'Yii::app()->indoFormat->number($data->deductionC)',
		),
		'remark',
		array(
				'header'=>'Status',
				'type'=>'raw',
				'value'=>'(isset($data->payroll->id)) ? CHtml::tag("span",array("class"=>"label label-success"),"Process") : 
				CHtml::tag("span",array("class"=>"label label-warning"),"Unprocess") ',
		),
	),
)); 

?>

<br/>

<h4 style="margin-top: -5px; padding: 8px; background-color:#E6E6E6">
Promotion (Same Department)</h4>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'g-newemployee-grid',
	'dataProvider'=>gPerson::model()->newPromotion,
	//'filter'=>$model,
	'template'=>'{items}',
	'htmlOptions'=>array("style"=>"padding-top:0px"),
	'columns'=>array(
		//array(
		//	'type'=>'raw',
		//	'value'=>'$data->photoPath',
		//	'htmlOptions'=>array("width"=>"50px"),
		//),
		array(
			'header'=>'Name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data->id)))',
		),
		array(
			'header'=>'Department',
			'value'=>'$data->mDepartment()',
		),
		array(
			'header'=>'Join Date',
			'value'=>'$data->companyfirst->start_date',
		),
		array(
				'header'=>'Basic Salary',
				'value'=>'Yii::app()->indoFormat->number($data->mBasicSalary)',
		),
		array(
				'header'=>'Benefit',
				'value'=>'Yii::app()->indoFormat->number($data->benefitC)',
		),
		array(
				'header'=>'Deduction',
				'value'=>'Yii::app()->indoFormat->number($data->deductionC)',
		),
		'remark',
		array(
				'header'=>'Status',
				'type'=>'raw',
				'value'=>'($data->payroll->category_id == 2) ? CHtml::tag("span",array("class"=>"label label-success"),"Process") : 
				CHtml::tag("span",array("class"=>"label label-warning"),"Unprocess") ',
		),
	),
)); 

?>

<br/>

<h4 style="margin-top: -5px; padding: 8px; background-color:#E6E6E6">
Deduction</h4>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'g-payroll-grid',
	'dataProvider'=>gPayrollDeduction::model()->currentDeduction,
	//'filter'=>$model,
	'template'=>'{items}',
	'htmlOptions'=>array("style"=>"padding-top:0px"),
	'columns'=>array(
		//array(
		//	'type'=>'raw',
		//	'value'=>'$data->photoPath',
		//	'htmlOptions'=>array("width"=>"50px"),
		//),
		array(
			'header'=>'Name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->parent->employee_name,Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data->parent_id)))',
		),
		array(
			'header'=>'Department',
			'value'=>'$data->parent->mDepartment()',
		),
		array(
			'header'=>'Start',
			'value'=>'$data->yearmonth_start',
		),
		array(
			'header'=>'End',
			'value'=>'$data->yearmonth_end',
		),
		array(
				'header'=>'Deduction',
				'value'=>'Yii::app()->indoFormat->number($data->parent->deductionC)',
		),
		'remark',
	),
)); 

?>

<br/>

<h4 style="margin-top: -5px; padding: 8px; background-color:#E6E6E6">
Resign</h4>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'g-newemployee-grid',
	'dataProvider'=>gPerson::model()->newResign,
	//'filter'=>$model,
	'template'=>'{items}',
	'htmlOptions'=>array("style"=>"padding-top:0px"),
	'columns'=>array(
		//array(
		//	'type'=>'raw',
		//	'value'=>'$data->photoPath',
		//	'htmlOptions'=>array("width"=>"50px"),
		//),
		array(
			'header'=>'Name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPayroll/view",array("id"=>$data->id)))',
		),
		array(
			'header'=>'Department',
			'value'=>'$data->mDepartment()',
		),
		array(
			'header'=>'Category',
			'value'=>'$data->payroll->category_id',
		),
		array(
			'header'=>'Resign Date',
			'value'=>'$data->status->start_date',
		),
		array(
				'header'=>'Basic Salary',
				'value'=>'Yii::app()->indoFormat->number($data->mBasicSalary)',
		),
		array(
				'header'=>'Benefit',
				'value'=>'Yii::app()->indoFormat->number($data->benefitC)',
		),
		array(
				'header'=>'Deduction',
				'value'=>'Yii::app()->indoFormat->number($data->deductionC)',
		),
		'remark',
		array(
				'header'=>'Status',
				'type'=>'raw',
				'value'=>'($data->payroll->category_id ==5) ? CHtml::tag("span",array("class"=>"label label-success"),"Process") : 
				CHtml::tag("span",array("class"=>"label label-warning"),"Unprocess") ',
		),
		
	),
)); 

?>
