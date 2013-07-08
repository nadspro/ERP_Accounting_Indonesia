<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = array(
    'Company News' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sCompanyNewsAdmin')),
    array('label' => 'View', 'icon' => 'edit', 'url' => array('/sCompanyNewsAdmin/view', "id" => $model->id)),
);

$this->menu1 = sCompanyNews::getTopUpdated();
$this->menu2 = sCompanyNews::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="iconic-article"></i>
        Update
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>