<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'I Learnings',
);

$this->menu = array(
    array('label' => 'Learning Calendar', 'url' => array('/m1/iLearning')),
    array('label' => 'List By Date', 'url' => array('/m1/iLearning/index3')),
);


//$this->menu5=array('Sylabus');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-book"></i>
        Learning List
    </h1>
</div>


<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
