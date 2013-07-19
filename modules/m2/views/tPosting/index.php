<?php
$this->breadcrumbs = array(
    'Posting',
);

$this->menu = array(
);

$this->menu1 = uJournal::getTopUpdated(1);
$this->menu2 = uJournal::getTopCreated(1);
?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog',
    'options' => array(
        'title' => 'Posting',
        'autoOpen' => false,
        'modal' => true,
    //'buttons'=>array(
    //		'OK'=>'js:function(){$(this).dialog("close");}',
    //),
    ),
));
echo 'Posting Complete...';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<div class="pull-right">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div>

<div class="page-header">
    <h1>
        Trial Balance
    </h1>
</div>

<?php /*
  <br/>
  <p>Current Period: <b><?php echo sParameter::item("cCurrentPeriod",201112); ?> </b></p>
  <br/>
  <p>

  <br/>
 */
?>

<?php
$this->widget('DropDownRedirect', array(
    'data' => tAccount::accountDetail(),
    'url' => $this->createUrl('/m2/tPosting/index', array_merge($_GET, array('acc' => '__value__'))),
    'select' => (isset($_GET['acc'])) ? $_GET['acc'] : "ALL",
));
?>
<?php echo CHtml::link(' Refresh', $this->createUrl('/m2/tPosting/index', $_GET)); ?>

<?php
if (isset($_GET['acc'])) {
    if ($_GET['acc'] != null) {
        echo "<b><p style='display: block;margin: 5px 0;padding: 10px;background-color: #EAEFFF;'>";
        echo "Current Filter :  " . tAccount::model()->findByPk((int) $_GET['acc'])->account_name;
        echo "</p></b>";
    }
}
?>


<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'template' => '{items}',
    'itemView' => '_view',
));
?>

