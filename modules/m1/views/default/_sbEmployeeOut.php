<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
<ul class="nav nav-list">
	<li class="nav-header"><i class="icon-fa-reorder"></i> Employee Out</span>
	</li>
</ul>
</div>

	<?php 
	//$this->widget('bootstrap.widgets.TbGridView', array(
	$this->widget('ext.groupgridview.TbGroupGridView', array(
		'extraRowColumns' => array('tMonth'),  
			'id'=>'employee-grid',
			'dataProvider'=>gPerson::model()->employeeOut(),
			'template'=>'{items}',
			'enableSorting'=>false,
			'htmlOptions'=>array('style'=>'padding-top:0'),
			'columns'=>array(
				array(
				'name' => 'tMonth',
				'value' => 'date("M-Y", strtotime($data->status->start_date))',
				'headerHtmlOptions' => array('style' => 'display: none'),
				'htmlOptions' => array('style' => 'display: none'),
				),
				array(
					'type'=>'raw',
					'value'=>'$data->gPersonPhoto',
					'htmlOptions'=>array("width"=>"55px"),
				),
				array(
					'type' => 'raw',
					'value'=> function($data){
						return CHtml::tag('div', array('style'=>'font-weight: bold'), $data->gPersonLink)
							. CHtml::tag('div', array('style'=>'color: #999; font-size: 11px'), $data->mDepartment())
							. $data->mLevel()
							. "</br>"
							. $data->company->start_date
							. " to "
							. $data->status->start_date;
					}
				),					
			),
	)); ?>
