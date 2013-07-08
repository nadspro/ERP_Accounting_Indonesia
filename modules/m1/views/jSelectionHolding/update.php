<?php
/* @var $this JSelectionController */
/* @var $model jSelection */

$this->breadcrumbs = array(
    'J Selections' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/jSelectionHolding')),
    array('label' => 'View', 'icon' => 'pencil', 'url' => array('view', 'id' => $model->id)),
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-tasks"></i>
        Update</h1>
</div>

<?php
echo $this->renderPartial('_form', array('model' => $model));
