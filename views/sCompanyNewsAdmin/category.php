<?php
$this->breadcrumbs = array(
    'Module' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Home', 'url' => array('/sCompanyNewsAdmin')),
);
?>

<div class="page-header">
    <i class="iconic-article"></i>
    News Category</h1>
</div>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'module-module-grid',
    'dataProvider' => sParameterNews::model()->search(),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => array(
        //'id',
        //'parent_id',
        'sort',
        'category_name',
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("sCompanyNewsAdmin/deleteCategory",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'sCompanyNewsAdmin/updateCategory',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Category',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
        ),
    ),
));
?>
<hr>

<?php echo $this->renderPartial('_formCategory', array('model' => $modelcategory)); ?>

