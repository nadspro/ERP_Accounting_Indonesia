<?php
$this->breadcrumbs=array(
		'G people'=>array('index'),
		$model->id,
);

$this->menu4=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m1/gPermission')),
);

$this->menu=array(
		//array('label'=>'Print Summary', 'icon'=>'print', 'url'=>array('/m1/gEss/summaryPermission',"pid"=>$model->id)),
);

//$this->menu1=gPermission::getTopUpdated();
//$this->menu2=gPermission::getTopCreated();
$this->menu5=array('Permission');

?>

<div class="row">
	<div class="span8">
		<div class="page-header">
			<h1>
				<i class="icon-fa-medkit"></i>
				<?php echo $model->employee_name; ?>
			</h1>
		</div>
	</div>
	<div class="span1">
		<?php echo $model->photoPath; ?>
	</div>
</div>



<?php
$this->widget('bootstrap.widgets.TbTabs', array(
		'type'=>'tabs', // 'tabs' or 'pills'
		'tabs'=>array(
				array('label'=>'Permission History','content'=>$this->renderPartial("_tabList", array("model"=>$model), true),'active'=>true),
				array('label'=>'Profile','content'=>$this->renderPartial("/gPerson/_personalInfo", array("model"=>$model), true)),
		),
));

