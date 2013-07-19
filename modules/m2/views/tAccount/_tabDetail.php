<h3>Account Properties</h3>

<?php
//$this->widget('bootstrap.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', array(
    'ItemColumns' => 2,
    'data' => array(
        'id' => 1,
        'account_type' => $model->cRoot,
        'currency' => $model->cCurrency,
        'state' => $model->cState,
        'has_child' => $model->haschildIsInherited,
        'parent_account' => $model->parentNameLink,
        'cash_bank' => $model->cashbankValue,
        'cash_bank_code' => $model->cashbankCodeValue,
        //'hutang' => (isset($model->hutang)) ? $model->hutang->setMvalue() : "Not Set",
        //'inventory' => (isset($model->inventory)) ? $model->inventory->setMvalue() : "Not Set",
    ),
    'attributes' => array(
        array('name' => 'account_type', 'label' => 'Account Type'),
        array('name' => 'currency', 'label' => 'Currency'),
        array('name' => 'state', 'label' => 'Status'),
        array('name' => 'has_child', 'label' => 'Has Child'),
        array('name' => 'parent_account', 'type'=>'raw', 'label' => 'Parent Account'),
        array('name' => 'cash_bank', 'label' => 'Cash Bank Account', 'visible' => (isset($model->cashbank))),
        array('name' => 'cash_bank_code', 'label' => 'Cash Bank Code', 'visible' => (isset($model->cashbankCode))),
        //array('name' => 'hutang', 'label' => 'Payable Account', 'visible' => (isset($model->hutang))),
        //array('name' => 'inventory', 'label' => 'Inventory Account', 'visible' => (isset($model->inventory))),
    ),
));
?>



<?php
if ($model->haschild) {
    ?>

    <hr />

    <h3>Child Account</h3>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 't-account-grid',
        'dataProvider' => tAccount::model()->search($model->id),
        'itemsCssClass' => 'table table-striped table-bordered',
        'template' => '{items}{pager}',
        'columns' => array(
            array(
                'name' => 'account_no',
                'type' => 'raw',
                'value' => 'CHtml::link($data->account_concat,Yii::app()->createUrl("/m2/tAccount/view",array("id"=>$data->id)))',
            ),
            array(
                'name' => 'haschild_id',
                'value' => '$data->haschildIsInherited',
            ),
            array(
                'header' => 'Account Type',
                'value' => '$data->cRoot',
            ),
            array(
                'header' => 'Currency',
                'value' => '$data->cCurrency',
            ),
            array(
                'header' => 'Status',
                'value' => '$data->cState',
            ),
        ),
    ));
    ?>

    <?php
}
?>

<hr />

<h3>Sibling Account</h3>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 't-account-grid',
    'dataProvider' => tAccount::model()->searchSibling($model->parent_id, $model->id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => array(
        array(
            'name' => 'account_no',
            'type' => 'raw',
            'value' => 'CHtml::link($data->account_concat,Yii::app()->createUrl("/m2/tAccount/view",array("id"=>$data->id)))',
        ),
        array(
            'name' => 'haschild_id',
            'value' => '$data->haschildIsInherited',
        ),
        array(
            'header' => 'Type Account',
            'value' => '$data->cRoot',
        ),
        array(
            'header' => 'Currency',
            'value' => '$data->cCurrency',
        ),
        array(
            'header' => 'Status',
            'value' => '$data->cState',
        ),
    ),
));
?>

<?php
if ($model->haschild) {
    ?>

    <hr />

    <h3>New Account</h3>
    <?php echo $this->renderPartial('_form', array('model' => $modelAccount)); ?>

    <?php
}
?>




