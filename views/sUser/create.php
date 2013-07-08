<?php
$this->breadcrumbs = array(
    'User' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sUser')),
);

$this->menu2 = sUser::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        <?php echo "Create New User"; ?>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>