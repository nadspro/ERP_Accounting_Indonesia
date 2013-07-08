<?php
$this->breadcrumbs = array(
    'G Cutis' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/m1/gPermission')),
        //array('label'=>'Manage gPerson','url'=>array('admin')),
);

//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-medkit"></i>
        Create Permission
    </h1>
</div>


<?php
echo $this->renderPartial('_formWithEmp', array('model' => $model));