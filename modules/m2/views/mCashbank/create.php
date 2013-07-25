<?php
$this->breadcrumbs = array(
    'Cash and Bank' => array('/m2/mCashbank'),
    'Create',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/mCashbank')),
);

$this->menu1 = tJournal::getTopUpdated(2);
$this->menu2 = tJournal::getTopCreated(2);
?>


<div class="page-header">
    <h1>
        Cash and Bank: Expense
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Expense', 'url' => Yii::app()->createUrl('/m2/mCashbank/create'), 'active' => true),
        array('label' => 'Income', 'url' => Yii::app()->createUrl('/m2/mCashbank/createIncome')),
    ),
));

echo $this->renderPartial('_tabCreateExpense', array('model' => $model));
