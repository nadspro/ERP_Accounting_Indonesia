<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = array(
    'Company News' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/sCompanyNewsAdmin')),
);

$this->menu1 = sCompanyNews::getTopUpdated();
$this->menu2 = sCompanyNews::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="iconic-article"></i>
        Create
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>