<?php
$this->breadcrumbs = array(
    'Chart of Accounts',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/tAccount')),
    array('label' => 'New Root Account', 'icon' => 'plus', 'url' => array('/m2/tAccount/create')),
    array('label' => 'Print List', 'icon' => 'print', 'url' => array('printList')),
);


$this->menu1 = tAccount::getTopUpdated();
//$this->menu2=tAccount::getTopCreated();
//$this->menu5=array('Root Account');
?>

<div class="page-header">
    <h1>
        Chart of Accounts
    </h1>
</div>

<div class="row">
    <div class="span3">

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

    </div>
    <div class="span6">


        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>

        <strong>Account List</strong>

        <div id="posts">
            <?php foreach ($dataProvider as $data): ?>
                <div class="post">

                    <?php
                    Yii::app()->clientScript->registerScript('search' . $data->id, "
				$('.hide-info'+$data->id).click(function(){
				$('.list'+$data->id).toggle();
				return false;
});
				");
                    ?>

                    <?php
                    if ($data->parent_id == 0) {
                        if ($data->childs)
                            echo "<b>";
                        echo CHtml::link($data->account_concat, array('view', 'id' => $data->id));
                        if ($data->childs)
                            echo "</b>";
                    } elseif ($data->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "<b>";
                        echo "--- " . CHtml::link($data->account_concat, array('view', 'id' => $data->id));
                        if ($data->childs)
                            echo "</b>";
                    } elseif ($data->getparent->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "<b>";
                        echo "------ " . CHtml::link($data->account_concat, array('view', 'id' => $data->id));
                        if ($data->childs)
                            echo "</b>";
                    } elseif ($data->getparent->getparent->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "<b>";
                        echo "--------- " . CHtml::link($data->account_concat, array('view', 'id' => $data->id));
                        if ($data->childs)
                            echo "</b>";
                    } elseif ($data->getparent->getparent->getparent->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "<b>";
                        echo "------------ " . CHtml::link($data->account_concat, array('view', 'id' => $data->id));
                        if ($data->childs)
                            echo "</b>";
                    } elseif ($data->getparent->getparent->getparent->getparent->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "<b>";
                        echo "--------------- " . CHtml::link($data->account_concat, array('view', 'id' => $data->id));
                        if ($data->childs)
                            echo "</b>";
                    } else {
                        if ($data->childs)
                            echo "<b>";
                        echo "------------------ " . CHtml::link($data->account_concat, array('view', 'id' => $data->id));
                        if ($data->childs)
                            echo "</b>";
                    }
                    ?>

                    <?php /*
                      <?php echo CHtml::link('<i class="icon-chevron-right"></i>','#',array('class'=>'hide-info'.$data->id)); ?>

                      <div class="list<?php echo $data->id ?>" style="display:none">

                      <?php
                      //$this->widget('bootstrap.widgets.TbDetailView', array(
                      $this->widget('ext.XDetailView', array(
                      'ItemColumns' => 2,
                      'data'=>array(
                      'id'=>1, 'account_type'=>$data->getRoot(),
                      'currency'=>$data->getCurrency(),
                      'state'=>$data->getState(),
                      'has_child'=>(isset($data->haschild)) ? $data->haschild->childName->name : "Not Set",
                      'cash_bank'=>(isset($data->cashbank)) ? $data->cashbank->mtext : "Not Set",
                      'hutang'=>(isset($data->hutang)) ? $data->hutang->setMvalue() : "Not Set",
                      'inventory'=>(isset($data->inventory)) ? $data->inventory->setMvalue() : "Not Set",
                      ),
                      'attributes'=>array(
                      array('name'=>'account_type', 'label'=>'Account Type'),
                      array('name'=>'currency', 'label'=>'Currency'),
                      array('name'=>'state', 'label'=>'Status'),
                      array('name'=>'has_child', 'label'=>'Has Child'),
                      array('name'=>'cash_bank', 'label'=>'Cash Bank Account'),
                      array('name'=>'hutang', 'label'=>'Payable Account'),
                      array('name'=>'inventory', 'label'=>'Inventory Account'),
                      ),
                      )); ?>
                      </div>

                     */ ?>


                </div>
            <?php endforeach; ?>
        </div>

        <?php
        $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
            'contentSelector' => '#posts',
            'itemSelector' => 'div.post',
            'loadingText' => 'Loading...',
            'donetext' => 'This is the end... ',
            'pages' => $pages,
        ));
        ?>

    </div>
</div>