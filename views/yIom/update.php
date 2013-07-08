<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = array(
    'Inter Office Memo' => array('index'),
    $model->subject => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/yIom')),
    array('label' => 'View', 'icon' => 'edit', 'url' => array('/yIom/view', "id" => $model->id)),
);

$this->menu1 = yIom::getTopUpdated();
$this->menu2 = yIom::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="iconic-article"></i>
        Update
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>