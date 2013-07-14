<?php
if (isset($model->getparent->getparent->getparent->getparent->name)) {
    $this->breadcrumbs = array(
        $model->getparent->getparent->getparent->getparent->name => array('view', 'id' => $model->getparent->getparent->getparent->id),
        $model->getparent->getparent->getparent->name => array('view', 'id' => $model->getparent->getparent->id),
        $model->getparent->getparent->name => array('view', 'id' => $model->getparent->id),
        $model->getparent->name => array('view', 'id' => $model->getparent->id),
        $model->name,
    );
} elseif (isset($model->getparent->getparent->getparent->name)) {
    $this->breadcrumbs = array(
        $model->getparent->getparent->getparent->name => array('view', 'id' => $model->getparent->getparent->getparent->id),
        $model->getparent->getparent->name => array('view', 'id' => $model->getparent->getparent->id),
        $model->getparent->name => array('view', 'id' => $model->getparent->id),
        $model->name,
    );
} elseif (isset($model->getparent->getparent->name)) {
    $this->breadcrumbs = array(
        $model->getparent->getparent->name => array('view', 'id' => $model->getparent->getparent->id),
        $model->getparent->name => array('view', 'id' => $model->getparent->id),
        $model->name,
    );
} elseif (isset($model->getparent->name)) {
    $this->breadcrumbs = array(
        $model->getparent->name => array('view', 'id' => $model->getparent->id),
        $model->name,
    );
} else {
    $this->breadcrumbs = array(
        $model->name,
    );
}

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/aOrganization')),
    //array('label'=>'Create Root', 'url'=>array('create')),
    array('label' => 'Update', 'icon' => 'edit', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete', 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);

$this->menu1 = aOrganization::getTopUpdated();
$this->menu2 = aOrganization::getTopCreated();
$this->menu3 = aOrganization::getTopRelated($model->id);
$this->menu5 = array('Organization');
?>

<div class="page-header">
    <h1>
        <i class="iconic-image"></i>
        <div style="width:50px; float:left; margin-right:10px">
        </div>
        <?php
        echo $model->name;
        echo ($model->topStatus);
        ?>
    </h1>
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
        $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => array(
                array('id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", array("model" => $model), true), 'active' => true),
                array('id' => 'tab2', 'label' => 'User Member', 'content' => $this->renderPartial("_tabUsername", array("model" => $model), true)),
                array('id' => 'tab3', 'label' => 'Logo', 'content' => $this->renderPartial("_tabLogo", array("model" => $model), true)),
            ),
        ));
        ?>

        <h3>Child Organization</h3>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 't-organization-grid',
            'dataProvider' => aOrganization::model()->searchChild($model->id),
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}',
            'columns' => array(
                //'branch_code_number',
                'branch_code',
                array(
                    'header' => 'Name',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->name, Yii::app()->createUrl("/aOrganization/view",array("id"=>$data->id)))',
                ),
                'custom1',
                'custom2',
                'custom3',
                array(
                    'header' => 'Info',
                    'type' => 'raw',
                    'value' => function($data) {
                        return CHtml::tag('div', array('style' => 'font-weight: bold'), $data->address)
                                . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->telephone);
                    },
                ),
                //'fax',
                //'email',
                //'website',
                array(
                    'class' => 'TbButtonColumn',
                    'template' => '{delete}',
                ),
            ),
        ));
        ?>


        <h3>New Child Organization</h3>

        <?php echo $this->renderPartial('_form', array('model' => $modelOrganization)); ?>

    </div>
</div>