<?php
/* @var $this BSorderDetailController */
/* @var $model vSorderDetail */

$this->breadcrumbs = array(
    'B Sorder Details' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/vSorder')),
);

$this->menu1 = vSorder::getTopUpdated(1);
$this->menu2 = vSorder::getTopCreated(1);
?>

<div class="page-header">
    <h1>
        Create
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'dataProvider' => $dataProvider)); ?>
