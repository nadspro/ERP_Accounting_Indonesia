<?php
$this->breadcrumbs = array(
    'Module' => array('index'),
    'Manage',
);


$this->menu = array(
        //array('label'=>'Create', 'url'=>array('create')),
);

$this->menu4 = sModule::getTopOther();
?>

<div class="page-header">
    <h1><i class="icon-fa-credit-card"></i>
        Data Module</h1>
</div>

<div class="row">
    <div class="span2">
        <?php
        $this->beginWidget('CTreeView', array(
            'id' => 'module-tree',
            //'data'=>$items,
            'url' => array('/sModule/ajaxFillTree'),
            'collapsed' => true,
            'unique' => true,
        ));
        $this->endWidget();
        ?>
    </div>
    <div class="span10">

        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'module-module-grid',
            'dataProvider' => $model->search(),
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}',
            'columns' => array(
                array(
                    'class' => 'EJuiDlgsColumn',
                    'template' => '{update}{delete}',
                    //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("sModule/delete",array("id"=>$data->id))',
                    'updateDialog' => array(
                        'controllerRoute' => 'sModule/update',
                        'actionParams' => array('id' => '$data->id'),
                        'dialogTitle' => 'Update Module',
                        'dialogWidth' => 512, //override the value from the dialog config
                        'dialogHeight' => 530
                    ),
                ),
                'id',
                array(
                    'header' => 'Application',
                    'name' => 'getparent.title',
                ),
                array(
                    'name' => 'name',
                ),
                array(
                    'name' => 'sort',
                ),
                array(
                    'name' => 'title',
                    'type' => 'raw',
                    'value' => 'CHtml::link(($data->parent_id == 0) ? $data->title : "--- ".$data->title,Yii::app()->createUrl("/sModule/view",array("id"=>$data->id)))'
                ),
                'link',
                'image'
            ),
        ));
        ?>
        <hr>

        <?php echo $this->renderPartial('_form', array('model' => $modelmodule)); ?>

    </div>
</div>
