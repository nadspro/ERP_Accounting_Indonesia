<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'g-person-grid',
	'dataProvider'=>gLeave::model()->onWaiting(),
	//'filter'=>$model,
	'template'=>'{items}',
	'columns'=>array(
		array(
			'type'=>'raw',
			'value'=>'$data->person->photoPath',
			'htmlOptions'=>array("width"=>"50px"),
		),
		array(
			'header'=>'Name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->person->employee_name,Yii::app()->createUrl("/m1/gLeave/view",array("id"=>$data->parent_id)))',
		),
		array(
			'header'=>'Department',
			'value'=>'$data->person->mDepartment()',
		),
		'start_date',
		'end_date',
		'number_of_day',
		array(
			'header'=>'Balance',
			'name'=>'person.leaveBalance.balance',
		),
		array(
			'header'=>'Status',
			'value'=>'$data->approved->name',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			//'template'=>'{update}{delete}',
			'template'=>'{delete}',
			//'updateButtonUrl'=>'Yii::app()->createUrl("/m1/gLeave/update",array("id"=>$data->id))',
			'deleteButtonUrl'=>'Yii::app()->createUrl("/m1/gLeave/delete",array("id"=>$data->id))',
		),
		array(
			'class'=>'TbButtonColumn',
			'template'=>'{print}{printcancel}',
			'buttons'=>array
			(
					'print' => array
					(
							'label'=>'Print',
							'url'=>'Yii::app()->createUrl("/m1/gLeave/printLeave",array("id"=>$data->id))',
							'visible'=>'$data->approved_id ==1',
							'options'=>array(
									'class'=>'btn btn-mini',
									'target'=>'_blank',
							),
					),
					'printcancel' => array
					(
							'label'=>'Print',
							'url'=>'Yii::app()->createUrl("/m1/gLeave/printCancellationLeave",array("id"=>$data->id))',
							'visible'=>'$data->approved_id ==8',
							'options'=>array(
									'class'=>'btn btn-mini',
									'target'=>'_blank',
							),
					),
			),

		),
		array(
			'class'=>'TbButtonColumn',
			'template'=>'{approved}',
			'buttons'=>array
			(
				'approved' => array
				(
					'label'=>'Approved',
					'url'=>'Yii::app()->createUrl("/m1/gLeave/approved",array("id"=>$data->id,"pid"=>$data->parent_id))',
					'visible'=>'$data->approved_id ==1 || $data->approved_id ==8',
					'options'=>array(
						'ajax'=>array(
							'type'=>'GET',
							'url'=>"js:$(this).attr('href')",
							'success'=>'js:function(data){
								$.fn.yiiGridView.update("g-person-grid", {
									data: $(this).serialize()
								});
							}',
						),
						'class'=>'btn btn-mini',
					),
				),
			),
		),
	),
)); 
