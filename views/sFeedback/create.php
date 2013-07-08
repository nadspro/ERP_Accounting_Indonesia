<?php
$this->breadcrumbs = array(
    'Feedback' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sFeedback')),
);

$this->menu1 = sFeedback::getTopUpdated();
$this->menu2 = sFeedback::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="iconic-comment"></i>
        Create
    </h1>
</div>


<?php echo $this->renderPartial('_form', array('model' => $model)); ?>