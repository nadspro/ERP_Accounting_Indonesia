<?php
$this->breadcrumbs = array(
    'Matrix' => array('index'),
    'Manage',
);

$this->menu = array(
        //array('label'=>'Create', 'url'=>array('create')),
);

//$this->menu5=array('Matrix');
?>

<div class="page-header">
    <i class="icon-fa-table"></i>
    Data Matrix</h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'module-matrix-grid',
    'dataProvider' => $model->search(),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => array(
        array(
            'class' => 'TbButtonColumn',
        ),
        'level',
        'level_r',
        'level_c',
        'level_u',
        'level_d',
    ),
));
?>

<hr>

<?php echo $this->renderPartial('_form', array('model' => $modelmatrix)); ?>
