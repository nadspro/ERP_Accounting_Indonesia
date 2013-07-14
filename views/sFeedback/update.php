<?php
$this->breadcrumbs = array(
    'Feedback' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sFeedback')),
    array('label' => 'View', 'icon' => 'edit', 'url' => array('view', 'id' => $model->id)),
);

$this->menu1 = sFeedback::getTopUpdated();
$this->menu2 = sFeedback::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="iconic-comment"></i>
        Update:
        <?php echo $model->id; ?>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>