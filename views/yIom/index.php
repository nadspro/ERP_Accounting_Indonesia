<?php
/* @var $this SCompanyNewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Inter Office Memo',
);

$this->menu = array(
        //array('label'=>'Category', 'url'=>array('/yIom/category')),
);

$this->menu1 = yIom::getTopUpdated();
$this->menu2 = yIom::getTopCreated();
$this->menu5 = array('Inter Office Memo');
?>

<div class="page-header">
    <h1>
        <i class="iconic-article"></i>
        Inter Office Memo
    </h1>
</div>

<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'companynews-grid',
    'dataProvider' => $model->search(),
    'itemsCssClass' => 'table table-striped',
    'template' => '{items}{pager}',
    //'filter'=>$model,
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'iom_number',
            'type' => 'raw',
            'value' => 'CHtml::link($data->iom_number,Yii::app()->createUrl("/yIom/view",array("id"=>$data->id)))',
        ),
        'iom_to',
        //'iom_cc',
        'iom_from',
        'subject',
        //'attachment',
        'iom_date',
        //array(
        //	'name'=>'content',
        //	'value'=>'peterFunc::shorten_string($data->content,20)',
        //),
        //'sender_by',
        //'sender_title',
        //'approved_by',
        //'approved_title',
        'created.username',
    ),
));
?>
