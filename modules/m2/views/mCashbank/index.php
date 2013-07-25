<?php
$this->breadcrumbs = array(
    'Cash and Bank',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m2/mCashbank')),
);


$this->menu1 = tJournal::getTopUpdated(2);
$this->menu2 = tJournal::getTopCreated(2);
$this->menu5 = array('Journal');


Yii::app()->clientScript->registerScript('search', "
		$('.anyobjectR view-right').submit(function(){
		$.fn.yiiListView.update('journallist', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<div class="pull-right" style="margin-top:20px;padding:10px 0">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div>

<div class="page-header">
    <h1>
        Cash and Bank
    </h1>
</div>


<?php
$this->widget('DropDownRedirect', array(
    'data' => tAccount::cashBankAccount("ALL"),
    'url' => $this->createUrl('/m2/mCashbank/index', array_merge($_GET, array('pid' => '__value__'))),
    'select' => (isset($_GET['pid'])) ? $_GET['pid'] : "(ALL)",
    'htmlOptions' => array('class' => 'span4'),
));
?>

<?php
if (isset($_GET['pid'])) {
    if ((int) $_GET['pid'] != 0) {
        echo "<b><p style='display: block;margin: 5px 0;padding: 10px;background-color: #EAEFFF;'>";
        echo "Filter By: " . tAccount::model()->findByPk((int) $_GET['pid'])->account_name;
        echo "</p></b>";
    }
}
?>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'template' => '{items}{pager}',
    'itemView' => '/tJournal/_view',
    'htmlOptions' => array(
        'style' => 'padding-top:0',
    )
));
?>
