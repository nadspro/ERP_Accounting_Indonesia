<?php
/* @var $this GSelectionController */
/* @var $model gSelection */

$this->breadcrumbs = array(
    'G Selections' => array('index'),
    $model->id,
);

$this->menu4 = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gSelection')),
);

$this->menu = array(
    array('label' => 'Update Profile', 'icon' => 'edit', 'url' => array('update', 'id' => $model->id)),
);

$this->menu1 = array(
    array('label' => 'Periodic Report', 'icon' => 'print', 'url' => array('report')),
);

$this->menu5 = array('Selection');
$this->menu7 = gSelection::getTopRecentSelection();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-tasks"></i>
        <?php echo $model->candidate_name; ?>
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => array(
        array('id' => 'tab1', 'label' => 'Final Result', 'content' => $this->renderPartial("_tabProgress", array("model" => $model), true), 'active' => true),
        array('id' => 'tab4', 'label' => 'Profile/Photo', 'content' => $this->renderPartial("_tabDetail", array("model" => $model), true)),
        array('id' => 'tab5', 'label' => 'Document', 'content' => $this->renderPartial("_tabDocument", array("model" => $model), true)),
    ),
));
?>

<?php //if ($model->company_id == sUser::model()->getGroup()) {  ?>

<div class="page-header">
    <h3>New Process</h3>
</div>

<?php echo $this->renderPartial('/gSelection/_formSelection', array('model' => $modelSelection)); //}  ?>

<hr/>

<div class="row">
    <div class="span5">
        <h3>Related Position</h3>

        <?php
        $this->widget('TbGridView', array(
            'id' => 'g-selection-related-grid',
            'dataProvider' => gSelection::model()->related($model),
            'enableSorting' => false,
            'template' => '{items}{pager}',
            //'filter'=>$model,
            'columns' => array(
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->PhotoPath,Yii::app()->createUrl("/' . $this->route . '/../view",array("id"=>$data->id,)))',
                    'htmlOptions' => array("width" => "40px"),
                ),
                //'code',
                array(
                    'header' => 'Candidate Name',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->candidate_name,Yii::app()->createUrl("/m1/gSelection/view",array("id"=>$data->id)))',
                ),
                'for_position',
                array(
                    'header' => 'Company / Dept',
                    'type' => 'raw',
                    'value' => function($data) {
                        return CHtml::tag('div', array(), $data->company->name)
                                . CHtml::tag('div', array(), $data->department->name);
                    }
                ),
            ),
        ));
        ?>

    </div>
    <div class="span5">
        <h3>Same Company</h3>
        <?php
        $this->widget('TbGridView', array(
            'id' => 'g-selection-company-grid',
            'dataProvider' => gSelection::model()->relatedCompany($model),
            'enableSorting' => false,
            'template' => '{items}{pager}',
            //'filter'=>$model,
            'columns' => array(
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->PhotoPath,Yii::app()->createUrl("/' . $this->route . '/../view",array("id"=>$data->id,)))',
                    'htmlOptions' => array("style" => "width:40px"),
                ),
                //'code',
                array(
                    'header' => 'Candidate Name',
                    'type' => 'raw',
                    //'value'=>'CHtml::link($data->candidate_name,Yii::app()->createUrl("/m1/gSelection/view",array("id"=>$data->id)))',
                    'value' => function($data) {
                        return CHtml::link($data->candidate_name, Yii::app()->createUrl("/m1/gSelection/view", array("id" => $data->id)))
                                . CHtml::tag('div', array('style' => 'color:grey'), substr($data->email, 0, 35))
                                . CHtml::tag('div', array('style' => 'color:grey'), substr($data->handphone, 0, 20) . ' ...');
                    }
                ),
                'for_position',
            //'department.name',
            //array(
            //		'header'=>'Source',
            //		'name'=>'source.name',
            //),
            ),
        ));
        ?>

    </div>
</div>