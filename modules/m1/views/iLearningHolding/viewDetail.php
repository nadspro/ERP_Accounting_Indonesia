<?php
$this->breadcrumbs=array(
	'I Learning Sches'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Home', 'icon'=>'home','url'=>array('/m1/iLearningHolding')),
	array('label'=>$model->getparent->learning_title, 'icon'=>'briefcase','url'=>array('/m1/iLearningHolding/view','id'=>$model->parent_id)),
	array('label'=>'Print Absence', 'icon'=>'print','url'=>array('/m1/iLearningHolding/printDetail','id'=>$model->id)),
);

$this->menu1=iLearningSch::getTopUpdated();
$this->menu2=iLearningSch::getTopCreated();
$this->menu5=array('Sylabus');

?>

<div class="page-header">
<h1><i class="icon-fa-book"></i>
<?php echo $model->getparent->learning_title; ?> | <?php echo $model->schedule_date ?></h1>
</div>

<div class="row">
<div class="span3">
	<table width="100%">
	<tr bgcolor="EAEFFF">
	<td  align="center"><h3><?php echo $model->mPartCount ?></h3>
	<h6 align="center" ><font COLOR="#999">Total Participant</font></h6></td>
	</tr>
	</table>
</div>

<div class="span3">
	<table width="100%">
	<tr bgcolor="EAEFFF">
	<td  align="center"><h3><?php echo $model->partCountFb ?></h3>
	<h6 align="center" ><font COLOR="#999">Total Feedback</font></h6></td>
	</tr>
	</table>
</div>

<div class="span3">
	<table width="100%">
	<tr bgcolor="EAEFFF">
	<td  align="center"><h3><?php echo $model->partResult ?></h3>
	<h6 align="center" ><font COLOR="#999">Final Result</font></h6></td>
	</tr>
	</table>
</div>
</div>

<br/>

<?php //$this->widget('bootstrap.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 2,
	'data'=>$model,
	'attributes'=>array(
		'trainer_name',
		'location',
		'schedule_date',
		array(
			'name'=>'status_id',
			'value'=>$model->status->name,
		),
		'additional_info',
		array(
			'name'=>'Participant',
			'value'=>$model->total_participant,
			'visible'=>($model->getparent->type_id ==3),
		),
	),
)); ?>

<?php
	if (is_dir(Yii::app()->basePath."/../shareimages/hr/learning/".$model->id))
		  $this->renderPartial('_tabPhotoView',array("id"=>$model->id));
?>

<?php if ($model->status_id == 1 ) { ?>

	<h3>New Participant</h3>

<?php echo $this->renderPartial('_formParticipant',array('model'=>$modelParticipant)); ?>

<?php } ?>


		<?php
		$this->widget('bootstrap.widgets.TbTabs', array(
			'type'=>'tabs', // 'tabs' or 'pills'
			'id'=>'tabs',
			'tabs'=>array(
				array('id'=>'tab1','label'=>'Detail','content'=>$this->renderPartial("_tabViewDetail", array("model"=>$model), true),'active'=>true),
				array('id'=>'tab2','label'=>'Feed Back','content'=>$this->renderPartial("_tabViewFeedback", array("model"=>$model), true)),
				array('id'=>'tab3','label'=>'Photo','content'=>$this->renderPartial("_tabPhoto", array("model"=>$modelPhoto), true)),
			),
		));

