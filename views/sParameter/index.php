<?php
$this->breadcrumbs = array(
    'Parameter' => array('index'),
    'Manage',
);
?>

<div class="page-header">
    <i class="icon-fa-beaker"></i>
    Data Parameter</h1>
</div>
<?php
$this->widget('DropDownRedirect', array(
    'data' => sParameter::items3("Any"),
    'url' => $this->createUrl($this->route, array_merge($_GET, array('type' => '__value__'))),
    'select' => (isset($_GET['type'])) ? $_GET['type'] : "(ALL)",
));
?>

<?php
//$this->widget('bootstrap.widgets.TbGridView', array(
$this->widget('ext.groupgridview.GroupGridView', array(
    'extraRowColumns' => array('type'),
    'id' => 'parameter-grid',
    'dataProvider' => $model->search($type),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => array(
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/sParameter/delete",array("pk1"=>$data->type,"pk2"=>$data->code))',
            'updateDialog' => array(
                'controllerRoute' => 'sParameter/update',
                'actionParams' => array('pk1' => '$data->type', 'pk2' => '$data->code', 'asDialog' => 1, 'gridId' => '$this->grid->id'),
                'dialogTitle' => 'Update Parameter',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
        'code',
        'name',
    ),
));
?>

<hr />

<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => array(
        array('label' => 'Existing Parameter', 'content' => $this->renderPartial("_formE", array("model" => $modelParameter), true), 'active' => true),
        array('label' => 'New Parameter', 'content' => $this->renderPartial("_form", array("model" => $modelParameter), true)),
    ),
));
?>

<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'cru-dialog',
    'options' => array(
        'title' => 'Update Detail',
        'autoOpen' => false,
        'modal' => true,
        'width' => '70%',
        'height' => '550',
    ),
));
?>

<iframe id="cru-frame"
        width="100%" height="100%">
</iframe>
<?php
$this->endWidget();
//--------------------- end new code --------------------------
?>

