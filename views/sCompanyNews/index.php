
<?php
/* @var $this SCompanyNewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Company News',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/site/login')),
);

$this->menu1 = sCompanyNews::getTopUpdated();
$this->menu2 = sCompanyNews::getTopCreated();
//$this->menu5=array('Company News');
?>

<div class="row">
    <div class="span8">
        <div class="page-header">
            <h1>
                <i class="iconic-article"></i>
                Company News
            </h1>
        </div>

        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'template' => '{pager}{items}{pager}',
            'itemView' => '_view',
        ));
        ?>

    </div>
    <div class="span4">

        <?php
        $this->widget('ext.albumPhoto', array('dir' => Yii::app()->basePath . "/../shareimages/photo/",
            'columns' => 2,
            'span' => 2,
            'limit' => 4,
            'header' => 5,
            'showDescription' => false,
        ));
        ?>

        <?php $this->renderPartial("/site/_category", array('category_id' => 1)) ?>
        <?php $this->renderPartial("/site/_category", array('category_id' => 2)) ?>
        <?php $this->renderPartial("/site/_category", array('category_id' => 3)) ?>
    </div>
</div>

