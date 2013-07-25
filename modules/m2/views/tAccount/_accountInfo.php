<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => array(
        'id' => 1,
        'account_type' => $model->cRoot,
        'currency' => $model->cCurrency,
        'state' => $model->cState,
        'has_child' => $model->haschildIsInherited,
        'parent_account' => $model->parentNameLink,
        'cash_bank' => $model->cashbankValue,
        'cash_bank_code' => $model->cashbankCodeValue,
        'entity' => $model->entityListComp,
        //'hutang' => (isset($model->hutang)) ? $model->hutang->setMvalue() : "Not Set",
        //'inventory' => (isset($model->inventory)) ? $model->inventory->setMvalue() : "Not Set",
    ),
    'attributes' => array(
        array('name' => 'account_type', 'label' => 'Account Type'),
        array('name' => 'currency', 'label' => 'Currency'),
        array('name' => 'state', 'label' => 'Status'),
        array('name' => 'has_child', 'label' => 'Has Child'),
        array('name' => 'parent_account', 'type'=>'raw', 'label' => 'Parent Account'),
        array('name' => 'entity', 'label' => 'Entity'),
        array('name' => 'cash_bank', 'label' => 'Cash Bank Account', 'visible' => (isset($model->cashbank))),
        array('name' => 'cash_bank_code', 'label' => 'Cash Bank Code', 'visible' => (isset($model->cashbankCode))),
        //array('name' => 'hutang', 'label' => 'Payable Account', 'visible' => (isset($model->hutang))),
        //array('name' => 'inventory', 'label' => 'Inventory Account', 'visible' => (isset($model->inventory))),
    ),
));
?>





