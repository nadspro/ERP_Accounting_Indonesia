<?php if (CHttpRequest::getParam("tab") != null): ?>

    <script>

        $(document).ready(function() {
            $('#tabs a:contains("<?php echo CHttpRequest::getParam("tab"); ?>")').tab('show');
        });

    </script>

<?php endif; ?>
</php>

<?php
$this->breadcrumbs = array(
    'G people' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/kPayroll')),
    array('label' => 'Print Profile', 'icon' => 'print', 'url' => array('printProfile', 'id' => $model->id)),
);


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();
$this->menu3 = gPerson::getTopRelated($model->employee_name);

$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gPersonCostcenter/index'), 'field_name' => 'employee_name');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        <?php echo $model->employee_name_r; ?>
    </h1>
</div>

<div class="row">
    <div class="span2">
        <?php
        echo $model->photoPath;
        ?>
    </div>

    <div class="span7">
        <?php echo $this->renderPartial('/gPerson/_personalInfo', array('model' => $model)); ?>
    </div>
</div>

<div class="row">
    <div class="span9">
        <?php
        $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'id' => 'tabs',
            'tabs' => array(
                array('id' => 'tab6', 'label' => 'Cost Center', 'content' => $this->renderPartial("_tabCostcenter", array("model" => $model, "modelCostcenter" => $modelCostcenter), true), 'active' => true),
                array('id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("/gPerson/_tabDetail", array("model" => $model), true)),
                array('id' => 'tab12', 'label' => 'Assignment', 'content' => $this->renderPartial("/gPerson/_mainCareer2", array("model" => $model), true)),
            ),
        ));
        ?>
    </div>
</div>

