<?php
$this->breadcrumbs = array(
    'Module' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sModule')),
    array('label' => 'View', 'icon' => 'edit', 'url' => array('view', 'id' => $model->id)),
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-credit-card"></i>
        <?php echo $model->title; ?>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>