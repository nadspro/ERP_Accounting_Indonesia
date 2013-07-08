<?php
$this->breadcrumbs = array(
    'Applicant' => array('index'),
    $model->id,
);

$this->menu5 = array('Applicant');
$this->menu7 = hApplicant::model()->getTopRecentApplicant();

$this->menu = array(
    array('label' => 'Vacancy', 'icon' => 'home', 'url' => array('/m1/hVacancy')),
    array('label' => 'Applicant', 'icon' => 'user', 'url' => array('/m1/hApplicant')),
    array('label' => 'Selection Registration', 'icon' => 'tint', 'url' => array('/m1/jSelection')),
    array('label' => 'Interview', 'icon' => 'volume-up', 'url' => array('/m1/hVacancy/interview')),
    array('label' => 'Print CV', 'icon' => 'print', 'url' => array('printCv', 'id' => $model->id)),
    array('label' => 'Transfer', 'icon' => 'forward', 'url' => '#', 'linkOptions' => array('submit' => array('transfer', 'id' => $model->id), 'confirm' => 'Are you sure you want to transfer this employee to Person Administration?')),
);
?>

<?php $this->beginContent('/layouts/column1N'); ?>


<div class="page-header">
    <h1>
        <i class="icon-fa-copy"></i>
<?php echo $model->applicant_name; ?>
    </h1>
</div>

<div class="row">
    <div class="span2">
        <p><?php echo $model->photoPath; ?></p>
    </div>
    <div class="span7">
<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => array(
        array('label' => 'Selection Process', 'content' => $this->renderPartial("_tabSelection", array("model" => $model), true), 'active' => true),
        array('label' => 'Candidate Profile', 'content' => $this->renderPartial("_tabDetail", array("model" => $model), true)),
        array('id' => 'tab2', 'label' => 'Create New', 'items' => array(
                array('label' => 'Experience', 'content' => $this->renderPartial("_tabExperience", array("model" => $model, "modelExperience" => $modelExperience), true)),
                array('label' => 'Education', 'content' => $this->renderPartial("_tabEducation", array("model" => $model, "modelEducation" => $modelEducation), true)),
                array('label' => 'Family', 'content' => $this->renderPartial("_tabFamily", array("model" => $model, "modelFamily" => $modelFamily), true)),
                array('label' => 'Non Formal Education', 'content' => $this->renderPartial("_tabEducationNf", array("model" => $model, "modelEducationNf" => $modelEducationNf), true)),
            )),
    ),
));
?>

    </div>
</div>

<p>

<div class="page-header">
    <h3>New Process</h3>
</div>

<?php echo $this->renderPartial('_formSelection', array('model' => $modelSelection)); //}  ?>

</p>

<?php
$this->endContent();

