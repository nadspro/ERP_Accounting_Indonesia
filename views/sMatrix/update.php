<?php
$this->breadcrumbs = array(
    'Matrix' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sMatrix')),
    array('label' => 'View', 'icon' => 'pencil', 'url' => array('view', 'id' => $model->id)),
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-table"></i>
        <?php echo $model->level; ?>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>