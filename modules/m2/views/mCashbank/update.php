<?php
$this->breadcrumbs = array(
    'Cash and Bank' => array('/m2/mCashbank'),
    'Update',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/mCashbank')),
);

$this->menu1 = uJournal::getTopUpdated(2);
$this->menu2 = uJournal::getTopCreated(2);
?>


<?php
if (!isset($model->cb_receiver) && !isset($model->cb_received_from)) {
    $this->widget('bootstrap.widgets.TbTabs', array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
            array('label' => 'Expense', 'content' => $this->renderPartial("_tabCreateExpense", array("model" => $model), true), 'active' => true),
            array('label' => 'Income', 'content' => $this->renderPartial("_tabCreateIncome", array("model" => $model), true)),
        ),
    ));
} elseif (isset($model->cb_receiver)) {

    $this->renderPartial("_tabCreateExpense", array("model" => $model));

} else {

	$this->renderPartial("_tabCreateIncome", array("model" => $model));

}
?>
