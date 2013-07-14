<?php
$this->breadcrumbs = array(
    'User' => array('/sUser'),
    'Manage',
);

$this->menu5 = array('User');

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sUser')),
    array('label' => 'Rights', 'icon' => 'certificate', 'url' => array('/rights')),
    array('label' => 'Modules', 'icon' => 'briefcase', 'url' => array('/sModule')),
);

$this->menu2 = sUser::getTopCreated();
$this->menu4 = sUser::getTopLastOneHour();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        User Management
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
        if (isset($_GET['pid'])) {
            if ((int) $_GET['pid'] != 0) {
                echo "<b><p style='display: block;margin: 5px 0;padding: 2px;background-color: yellow;'>";
                echo "Filter By Company: " . aOrganization::model()->findByPk((int) $_GET['pid'])->name;
                echo "</p></b>";
            }
        }
        ?>

        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'sortableAttributes' => array('last_login', 'created_date'),
            'itemView' => '_view',
        ));
        ?>

    </div>
</div>
