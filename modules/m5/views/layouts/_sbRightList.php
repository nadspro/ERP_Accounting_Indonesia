<?php if (!empty($this->menu5) && (!Yii::app()->user->isGuest)): ?>	

<br/>
<ul class="nav nav-list">

<?php 
 $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create New '.$this->menu5[0],
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'large', // '', 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl($this->module->id.'/'.$this->id.'/create'),
	'block'=>true,
)); 

?>
</ul>
<br/>

<?php endif; ?>		 

<?php /*
<?php
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Operation',
    'headerIcon' => 'icon-wrench',
));

$this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>$this->menu,
)); 

$this->endWidget();
?>

*/ ?>

<?php
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Top Interview',
    'headerIcon' => 'icon-wrench',
));

$this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>$this->menu4,
)); 

$this->endWidget();
?>


<?php
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Top Recent',
    'headerIcon' => 'icon-wrench',
));

$this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>$this->menu8,
)); 

$this->endWidget();
