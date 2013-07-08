<?php
$this->breadcrumbs = array(
    'G Cutis' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu4 = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gPermission')),
);

//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
$this->menu5 = array('Permission');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-medkit"></i>
        Update:
        <?php echo $model->person->employee_name; ?>
    </h1>
</div>



<?php
echo $this->renderPartial('_formUpdate', array('model' => $model));
