<?php
/* @var $this GVacancyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Vacancies',
);

$this->menu5 = array('Vacancy');
$this->menu7 = hVacancy::model()->getTopRecentVacancy();

$this->menu10 = array(
    array('label' => 'Vacancy', 'icon' => 'home', 'url' => array('/m1/hVacancy')),
    array('label' => 'Applicant', 'icon' => 'user', 'url' => array('/m1/hApplicant')),
    array('label' => 'Selection Registration', 'icon' => 'tint', 'url' => array('/m1/jSelection')),
    array('label' => 'Interview', 'icon' => 'volume-up', 'url' => array('/m1/hVacancy/interview')),
);
$this->menu4 = hVacancyApplicant::model()->getTopRecentInterview();
$this->menu8 = hApplicant::model()->getTopRecentApplicant();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-paper-clip"></i>
        Vacancies List
    </h1>
</div>

<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'template' => '{items}{pager}',
    'itemView' => '_view',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    )
));