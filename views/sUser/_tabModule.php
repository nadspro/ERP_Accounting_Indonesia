<h3>Rights</h3>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'mat-user-module-grid1',
    'dataProvider' => sUser::model()->userRight($model->id),
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'template' => '{items}{pager}',
    'columns' => array(
        array(
            'header' => 'Roles',
            'name' => 'itemname',
        ),
    )
));
?>

<h3>Modules</h3>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'mat-user-module-grid',
    'dataProvider' => sUserModule::model()->searchUser($model->id),
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'template' => '{items}{pager}',
    'columns' => array(
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("sUser/deleteModule",array("id"=>$data->id))',
        ),
        /* 				array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template'=>'{myupdate}',
          'buttons'=>array
          (
          'myupdate' => array
          (
          'label'=>'<i class="icon-pencil"></i>',
          //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/detail.png',
          'url'=>'
          Yii::app()->createUrl("/sUser/updateModule",
          array("id"=>$data->id, "s_user_id"=>$data->s_user_id, "asDialog"=>1,"gridId"=>$this->grid->id))
          ',

          'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;} ',

          ),
          ),
          ),
         */
        //array(
        //		'name'=>'id',
        //		'header'=>'Sort',
        //		'value'=>'$data->s_module->sort',
        //),
        array(
            'name' => 's_module_id',
            'type' => 'raw',
            'value' => '($data->s_module->parent_id == 0) ?
						CHtml::link($data->s_module->title,Yii::app()->createUrl("/sModule/view",array("id"=>$data->s_module->id))) :
						CHtml::link("--- ".$data->s_module->title,Yii::app()->createUrl("/sModule/view",array("id"=>$data->s_module->id)))',
        ),
        //'s_module.description',
        array(
            'name' => 's_matrix_id',
            'value' => '$data->s_matrix->level',
        ),
    ),
));
?>
<hr>
<?php
$this->renderPartial('_formModuleAdd', array('model' => $modelModule, 'modelParent' => $model));
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
        'height' => '400',
    ),
));
?>
<iframe id="cru-frame" width="100%"
        height="100%"></iframe>
        <?php
        $this->endWidget();
//--------------------- end new code --------------------------
        ?>

