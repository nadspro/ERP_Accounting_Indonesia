<?php if (!empty($this->menu5)): ?>

<br />
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
<br />

<?php endif; ?>

<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-application_side_list">Navigation</li>
</ul>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>$this->menu4,
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-text_list_bullets">Operation</li>
</ul>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>$this->menu,
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-printer">Report</li>
</ul>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>$this->menu1,
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-tick">Quick List</li>
</ul>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>$this->menu7,
)); ?>
<br />

