<?php
$this->breadcrumbs=array(
		'Applicant'=>array('index'),
);

$this->menu7=hVacancy::model()->getTopRecentVacancy();

$this->menu=array(
		array('label'=>'Vacancy', 'icon'=>'home', 'url'=>array('/m1/hVacancy')),
		array('label'=>'Applicant', 'icon'=>'user', 'url'=>array('/m1/hApplicant')),
		array('label'=>'Selection Registration', 'icon'=>'tint', 'url'=>array('/m1/jSelection')),
		array('label'=>'Interview', 'icon'=>'volume-up', 'url'=>array('/m1/hVacancy/interview')),
);
$this->menu4=hVacancyApplicant::model()->getTopRecentInterview();
$this->menu8=hApplicant::model()->getTopRecentApplicant();

?>

<?php $this->beginContent('/layouts/column1N'); ?>


<div class="page-header">
	<h1>
		<i class="icon-fa-paper-clip"></i>
		Applicant Interview Status
	</h1>
</div>

<?php foreach ($dataProvider->getData() as $data) { ?>
	<div class="row">
	<div class="span6">
		<h4 style="padding-bottom:4px;border-bottom-style:solid;border-color:grey;border-width:1px;">
			<?php echo CHtml::link($data->applicant->applicant_name." -> ".
			$data->vacancy->vacancy_title." -> ".$data->vacancy->company->name,Yii::app()->createUrl('/m1/hVacancy/interviewDetail',
			array('id'=>$data->id))); ?>
			
		</h4>
	
		<?php 
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'form-'.$data->id,
				'enableAjaxValidation'=>false,
				'action'=>($this->id == "interview") ? array('/m1/hVacancy/interview','id'=>$data->id) :
				array('/m1/hVacancy/interviewDetail','id'=>$data->id),
			)); ?>
			<?php echo CHtml::activeTextArea($model,'comment',array('rows'=>5, 'class'=>'span6')); ?>		
			
			<?php	
				$this->widget('zii.widgets.jui.CJuiButton', array(
					'buttonType'=>'submit',
					'name'=>'btnShare-'.$data->id,
					'caption'=>'Comment',
					'options'=>array('icons'=>'js:{secondary:"ui-icon-extlink"}'),
				));			
				
				
			?>
	
		<?php $this->endWidget(); ?>
		<?php foreach ($data->comment as $comment) { ?>
			<div class="row" style="margin-bottom:10px">
				<div class="span1">
					<?php echo CHtml::image(Yii::app()->request->baseUrl . "/shareimages/nophoto.jpg", 'No Photo', array("width"=>"100%",'id'=>'photo')); ?>
				</div>
				<div class="span5">
					<b><?php echo sUser::model()->findName((int)$comment->user_id); ?></b>
					<div style="color:grey;float:right;">
						<?php echo waktu::nicetime($comment->created_date); ?><br/>
					</div>
					<div style="float:clear;">
						<?php echo $comment->comment;?>	
					</div>
				</div>
			</div>
		<?php } ?>
		
		
		
		
	</div>
	</div>
	<br/>	
<?php } ?>

<?php $this->endContent(); 