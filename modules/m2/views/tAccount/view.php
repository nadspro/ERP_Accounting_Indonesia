<?php
if (isset($model->getparent->getparent->getparent->account_name)) {
    $this->breadcrumbs = array(
        $model->getparent->getparent->getparent->account_name => array('view', 'id' => $model->getparent->getparent->getparent->id),
        $model->getparent->getparent->account_name => array('view', 'id' => $model->getparent->getparent->id),
        $model->getparent->account_name => array('view', 'id' => $model->getparent->id),
        $model->account_name,
    );
} elseif (isset($model->getparent->getparent->account_name)) {
    $this->breadcrumbs = array(
        $model->getparent->getparent->account_name => array('view', 'id' => $model->getparent->getparent->id),
        $model->getparent->account_name => array('view', 'id' => $model->getparent->id),
        $model->account_name,
    );
} elseif (isset($model->getparent->account_name)) {
    $this->breadcrumbs = array(
        $model->getparent->account_name => array('view', 'id' => $model->getparent->id),
        $model->account_name,
    );
} else {
    $this->breadcrumbs = array(
        $model->account_name,
    );
}


$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/tAccount')),
    array('label' => 'Update', 'icon' => 'edit', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete', 'icon' => 'remove', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?'),
        'visible' => empty($model->hasJournal)),
    array('label' => 'Generate Empty Balance', 'icon' => 'random', 'visible' => $model->isEmptyBalance, 'url' => array('generate', 'id' => $model->id)),
);

$this->menu1 = tAccount::getTopUpdated();
$this->menu2 = tAccount::getTopCreated();
$this->menu3 = tAccount::getTopRelated($model->account_name);
?>

<div class="page-header">
    <h1>
        <?php echo $model->account_no . ". " . $model->account_name; ?>
    </h1>
</div>

<div class="row">
    <div class="span2">

        <h5>All Tree</h5>

        <?php
        $Hierarchy = tAccount::model()->findAll(array('condition' => 'parent_id = 0'));

        foreach ($Hierarchy as $Hierarchy) {
            $models = tAccount::model()->findByPk($Hierarchy->id);
            $items[] = $models->getTree();
        }

        $this->beginWidget('CTreeView', array(
            'id' => 'module-tree',
            //'data'=>$items,
            'url' => array('/m2/tAccount/ajaxFillTree'),
                //'collapsed'=>true,
                //'unique'=>true,
        ));
        $this->endWidget();
        ?>

        <h5>Parent Family</h5>

        <?php
        $menu = array();

        if (isset($_GET['id']))
            $menu = tAccount::getParentFamily($_GET['id']);


        $this->widget('bootstrap.widgets.TbMenu', array(
            'type' => 'list',
            'items' => $menu,
        ));
        ?>

        <h5>Current Tree</h5>
        <?php
        if (isset($_GET['id'])) {
            $Hierarchy1 = tAccount::model()->findAll(array('condition' => 'id = ' . $_GET['id']));

            foreach ($Hierarchy1 as $Hie) {
                if ($Hie->parent_id != 0) {
                    $models1 = tAccount::model()->findByPk($Hie->id);
                    $items1[] = $models1->getTree();
                }
                else
                    $items1[] = array();
            }

            $this->beginWidget('CTreeView', array(
                'id' => 'module-tree2',
                'data' => $items1,
                    //'url' => array('/aOrganization/ajaxFillTreeId','id'=>$_GET['id']),
                    //'collapsed'=>true,
                    //'unique'=>true,
            ));
            $this->endWidget();
        }
        ?>


    </div>
    <div class="span7">

		<?php
			$this->renderPartial('_accountInfo',array('model'=>$model));
		?>


		<?php
		if ($model->hasChild) {
			$this->widget('bootstrap.widgets.TbTabs', array(
				'type' => 'tabs', // 'tabs' or 'pills'
				'tabs' => array(
					array('label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", array("model" => $model, "modelAccount" => $modelAccount), true), 'active' => true),
					array('label' => 'Entity', 'content' => $this->renderPartial("_tabEntity", array("model" => $model, 'modelEntity' => $modelEntity), true)),
					array('label' => 'Sub Account', 'content' => $this->renderPartial("_tabSub", array("model" => $model), true)),
					array('label' => 'Linked Module', 'content' => $this->renderPartial("_tabModule", array("model" => $model), true)),
				),
			));

		} else {
			$this->widget('bootstrap.widgets.TbTabs', array(
				'type' => 'tabs', // 'tabs' or 'pills'
				'tabs' => array(
					array('label' => 'Balance', 'content' => $this->renderPartial("_tabBalance", array("model" => $model, "modelAccount" => $modelAccount), true),'active'=>true),
					//array('label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", array("model" => $model, "modelAccount" => $modelAccount), true)),
					array('label' => 'Entity', 'content' => $this->renderPartial("_tabEntity", array("model" => $model, 'modelEntity' => $modelEntity), true)),
					array('label' => 'Sub Account', 'content' => $this->renderPartial("_tabSub", array("model" => $model), true)),
					array('label' => 'Linked Module', 'content' => $this->renderPartial("_tabModule", array("model" => $model), true)),
				),
			));
		}

		?>
    </div>
</div>

