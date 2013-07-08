<?php
$this->breadcrumbs = array(
    'G Cutis' => array('index'),
    'Create',
);

$this->menu4 = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gLeave')),
);

//$this->menu1=gLeave::getTopUpdated();
//$this->menu2=gLeave::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-suitcase"></i>
        Extended Leave
    </h1>
</div>


<?php
echo $this->renderPartial('_formExtendedWithEmp', array('model' => $model));
