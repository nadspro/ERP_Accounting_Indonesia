<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = array(
    'Inter Office Memo' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/yIom')),
);

$this->menu1 = yIom::getTopUpdated();
$this->menu2 = yIom::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="iconic-article"></i>
        Create
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>