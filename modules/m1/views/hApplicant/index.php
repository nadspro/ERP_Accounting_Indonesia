<?php
$this->breadcrumbs = array(
    'Applicant' => array('index'),
);

$this->menu5 = array('Applicant');
$this->menu7 = hApplicant::model()->getTopRecentApplicant();

$this->menu = array(
    array('label' => 'Vacancy', 'icon' => 'home', 'url' => array('/m1/hVacancy')),
    array('label' => 'Applicant', 'icon' => 'user', 'url' => array('/m1/hApplicant')),
    array('label' => 'Selection Registration', 'icon' => 'tint', 'url' => array('/m1/jSelection')),
    array('label' => 'Interview', 'icon' => 'volume-up', 'url' => array('/m1/hVacancy/interview')),
);
?>

<?php $this->beginContent('//layouts/column1N'); ?>


<div class="page-header">
    <h1>
        <i class="icon-fa-copy"></i>
        Applicant
    </h1>
</div>

<?php
echo $this->renderPartial('_search', array('model' => $model));
?>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>

<?php
$this->endContent();
