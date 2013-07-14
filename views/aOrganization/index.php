<?php
$this->breadcrumbs = array(
    'Organization Structure',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/aOrganization')),
);

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
$this->menu5 = array('Organization');
?>


<div class="page-header">
    <h1>
        <i class="iconic-image"></i>
        Organization Structure</h1>
</div>

<div class="row">
    <div class="span3">

        <h5>All Tree</h5>

        <?php
        $this->beginWidget('CTreeView', array(
            'id' => 'module-tree',
            //'data'=>$items,
            'url' => array('/aOrganization/ajaxFillTree'),
            'collapsed' => true,
            'unique' => true,
        ));
        $this->endWidget();
        ?>

        <h5>Parent Family</h5>

        <?php
        $menu = array();

        if (isset($_GET['id']))
            $menu = aOrganization::getParentFamily($_GET['id']);


        $this->widget('bootstrap.widgets.TbMenu', array(
            'type' => 'list',
            'items' => $menu,
        ));
        ?>

        <h5>Current Tree</h5>
        <?php
        if (isset($_GET['id'])) {
            $Hierarchy = aOrganization::model()->findAll(array('condition' => 'id = ' . $_GET['id']));

            foreach ($Hierarchy as $Hierarchy) {
                if ($Hierarchy->parent_id != 0) {
                    $models = aOrganization::model()->findByPk($Hierarchy->id);
                    $items[] = $models->getTree();
                }
                else
                    $items[] = array();
            }

            $this->beginWidget('CTreeView', array(
                'id' => 'module-tree2',
                'data' => $items,
                    //'url' => array('/aOrganization/ajaxFillTreeId','id'=>$_GET['id']),
                    //'collapsed'=>true,
                    //'unique'=>true,
            ));
            $this->endWidget();
        }
        ?>

    </div>
    <div class="span6">


        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
        ));
        ?>

    </div>
</div>