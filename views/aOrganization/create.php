<?php
$this->breadcrumbs = array(
    $model->name,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/aOrganization')),
);

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="iconic-image"></i>
        Create New Organization
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>