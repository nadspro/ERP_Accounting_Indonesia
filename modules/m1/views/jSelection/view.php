<?php
$this->breadcrumbs = array(
    'Selection' => array('index'),
);

$this->menu7 = hApplicant::model()->getTopRecentApplicant();

$this->menu = array(
    array('label' => 'Vacancy', 'icon' => 'home', 'url' => array('/m1/hVacancy')),
    array('label' => 'Applicant', 'icon' => 'user', 'url' => array('/m1/hApplicant')),
    array('label' => 'Selection Registration', 'icon' => 'tint', 'url' => array('/m1/jSelection')),
    array('label' => 'Interview', 'icon' => 'volume-up', 'url' => array('/m1/hVacancy/interview')),
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-tasks"></i>
        <?php echo $model->category->name; ?></h1>
</div>

<?php
$this->widget('TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'pic',
        array(
            'label' => 'Category',
            'name' => 'category.name',
        ),
        'schedule_date',
        'additional_info',
        //'cost',
        array(
            'label' => 'Status',
            'name' => 'status.name',
        ),
    ),
));
?>


<div class="page-header">
    <h3>New Participant</h3>
</div>

<?php if ($model->partCount() == 15 || $model->status_id != 1 || strtotime($model->schedule_date) < time()) { ?>
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Full or Closed or Passed Date!</strong> The Registration is full or has been closed by Selection Holding Administrator
    </div>
    <?php
}
else
    echo $this->renderPartial('_formParticipant', array('model' => $modelParticipant));
?>


<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'id' => 'tabs',
    'tabs' => array(
        array('id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabViewDetail", array("model" => $model), true), 'active' => true),
    ),
));


