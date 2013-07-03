<?php
/* @var $this HVacancyController */
/* @var $model hVacancy */

$this->breadcrumbs=array(
	'H Vacancies'=>array('index'),
	'Create',
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

<div class="page-header">
<h1>
<i class="icon-fa-paper-clip"></i>
Update</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); 