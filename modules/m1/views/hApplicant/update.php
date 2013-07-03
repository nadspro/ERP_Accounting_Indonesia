<?php
$this->breadcrumbs=array(
		'G people'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);


$this->menu5=array('Applicant');
$this->menu7=hApplicant::model()->getTopRecentApplicant();

$this->menu=array(
		array('label'=>'Vacancy', 'icon'=>'home', 'url'=>array('/m1/hVacancy')),
		array('label'=>'Applicant', 'icon'=>'user', 'url'=>array('/m1/hApplicant')),
		array('label'=>'Selection Registration', 'icon'=>'tint', 'url'=>array('/m1/jSelection')),
		array('label'=>'Interview', 'icon'=>'volume-up', 'url'=>array('/m1/hVacancy/interview')),
);
?>

<?php $this->beginContent('/layouts/column1N'); ?>

<div class="page-header">
	<h1>
		<i class="icon-fa-copy"></i>
		<?php echo $model->applicant_name; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

<?php $this->endContent(); 