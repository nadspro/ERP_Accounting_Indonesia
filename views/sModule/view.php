<?php
$this->breadcrumbs = array(
    'Module' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sModule')),
        //array('label'=>'Update', 'icon'=>'pencil','url'=>array('update','id'=>$model->id)),
);

$this->menu4 = sModule::getTopOther();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-credit-card"></i>
        <?php echo $model->title; ?>
    </h1>
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
    <div class="span7">
        <?php
        $this->widget('bootstrap.widgets.TbDetailView', array(
//$this->widget('bootstrap.widgets.TbEditableDetailView', array(
            'data' => $model,
            //'url' => $this->createUrl('sModule/updateAjax'), 
            'attributes' => array(
                array(
                    'name' => 'getparent.title',
                    'label' => 'Parent'
                ),
                'title',
                'description',
                'link',
                'image',
            ),
        ));
        ?>

        <h3>User on this Module</h3>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'user-module-grid',
            'dataProvider' => sUserModule::model()->searchModule($model->id),
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}',
            'columns' => array(
                array(
                    'name' => 's_user.username',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->s_user->username,Yii::app()->createUrl("/sUser/view",array("id"=>$data->s_user->id)))',
                ),
                array(
                    'name' => 's_user.default_group',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->s_user->organization->name,Yii::app()->createUrl("/aOrganization/view",array("id"=>$data->s_user->default_group)))',
                ),
                array(
                    'name' => 's_user.status_id',
                    'value' => '$data->s_user->status->name',
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{delete}',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("/sModule/deleteUserModule",array("id"=>$data->id))',
                ),
            ),
        ));
        ?>

        <h3>Add New User</h3>
        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'user-module-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
        ));
        ?>


        <?php echo $form->dropDownListRow($modelUserModule, 's_user_id', sUser::model()->allUsers()); ?>

        <?php //echo $form->dropDownListRow($modelUserModule,'s_matrix_id', sMatrix::items('sMatrix'),array('class'=>'span3'));  ?>
        <?php echo $form->dropDownListRow($modelUserModule, 's_matrix_id', array("5" => "admin"), array('class' => 'span3')); ?>

        <div class="form-actions">
            <?php echo CHtml::htmlButton($modelUserModule->isNewRecord ? '<i class="icon-ok"></i> Create' : '<i class="icon-ok"></i> Save', array('class' => 'btn', 'type' => 'submit')); ?>
        </div>


        <?php $this->endWidget(); ?>

    </div>
</div>
