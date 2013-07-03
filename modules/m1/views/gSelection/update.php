<?php
$this->breadcrumbs=array(
		'G Selections'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu4=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m1/gSelection')),
);

$this->menu=array(
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Report', 'icon'=>'print', 'url'=>array('report')),
);

$this->menu1=gSelection::getTopUpdated();
$this->menu2=gSelection::getTopCreated();
$this->menu5=array('Selection');
?>

<div class="page-header">
<h1>
		<i class="icon-fa-tasks"></i>
	Update
</h1>
</div>

<?php echo $this->renderPartial('/gSelection/_form', array('model'=>$model));