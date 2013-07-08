<?php
/* @var $this JSelectionController */
/* @var $model jSelection */

$this->breadcrumbs = array(
    'J Selections' => array('index'),
    'Create',
);

$this->menu = array(
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-tasks"></i>
        Create</h1>
</div>

<?php
echo $this->renderPartial('_form', array('model' => $model));
