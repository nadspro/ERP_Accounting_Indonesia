<?php
$this->breadcrumbs = array(
    $model->name,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/aOrganization')),
    array('label' => 'View', 'icon' => 'pencil', 'url' => array('view', 'id' => $model->id)),
);

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
$this->menu3 = aOrganization::getTopRelated($model->id);
$this->menu5 = array('Organization');
?>

<div class="page-header">
    <h1>
        <i class="iconic-image"></i>
        Update:
        <?php echo $model->name; ?>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>