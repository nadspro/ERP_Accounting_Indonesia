<?php
$this->breadcrumbs = array(
    'User' => array('view'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sUser')),
    array('label' => 'Rights', 'icon' => 'certificate', 'url' => array('/rights/assignment/user', 'id' => $model->id)),
    array('label' => 'Update', 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete', 'icon' => 'trash', 'url' => array('delete', 'id' => $model->id)),
    array('label' => 'Update Password', 'icon' => 'edit', 'url' => array('updatePassword', 'id' => $model->id)),
    array('label' => 'Duplicate', 'icon' => 'upload', 'url' => array('duplicate', 'id' => $model->id)),
    array('label' => ($model->status_id == 1) ? 'Set NON ACTIVE' : 'Set ACTIVE', 'icon' => 'random', 'url' => array('toggleStatus', 'id' => $model->id)),
);

$this->menu2 = sUser::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        <?php echo CHtml::encode($model->username); ?>
    </h1>
</div>

<div class="row">
    <div class="span4">

        <?php
        $Hierarchy = aOrganization::model()->findAll(array('condition' => Yii::app()->params['parent_organization_filter']));

        foreach ($Hierarchy as $Hierarchy) {
            $models = aOrganization::model()->findByPk($Hierarchy->id);
            $items[] = $models->getTreeUser();
        }

        $this->beginWidget('CTreeView', array(
            'id' => 'module-tree',
            'data' => $items,
                //'url' => array('/aOrganization/ajaxFillUser'),
                //'collapsed'=>true,
                //'unique'=>true,
        ));
        $this->endWidget();
        ?>

    </div>
    <div class="span5">
        <?php
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                'full_name',
                'username',
                //'password',
                array(
                    'label' => 'Default Group',
                    'value' => aOrganization::model()->findByPk($model->default_group)->name,
                ),
                array(
                    'label' => 'Status',
                    'value' => $model->status->name,
                ),
                array(
                    'label' => 'SSO',
                    'value' => $model->sso(),
                ),
            ),
        ));
        ?>
        <br/>

        <?php
        $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => array(
                array('label' => 'Module and Rights', 'content' => $this->renderPartial("_tabModule", array("model" => $model, "modelModule" => $modelModule), true), 'active' => true),
                //array('label'=>'Rights', 'content'=>$this->renderPartial("_tabRight", array("model"=>$model), true)),
                array('label' => 'Entity Group', 'content' => $this->renderPartial("_tabGroup", array("model" => $model, "modelGroup" => $modelGroup), true)),
                array('label' => 'Notification Group', 'content' => $this->renderPartial("_tabNotifGroup", array("model" => $model), true)),
                array('label' => 'SSO', 'content' => $this->renderPartial("_tabSSO", array("model" => $model), true)),
            ),
        ));
        ?>

    </div>
</div>
