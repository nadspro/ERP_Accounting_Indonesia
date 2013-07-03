<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-text_list_bullets">Operation</li>
</ul>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>$this->menu,
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-application_side_list">Filter By</li>
</ul>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>$this->menu7,
)); ?>
<br />


