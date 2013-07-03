<?php $this->widget('ext.bootstrap.widgets.TbGridView', array(
	'id'=>'g-recruitment-progress-grid',
	'dataProvider'=>gSelectionProgress::model()->search($model->id),
	//'filter'=>false,
	'columns'=>array(
		array(
			'header'=>'Process',
			'name'=>'workflow.name',
			'htmlOptions'=>array(
				'style'=>'width: 120px;'
			),
		),
		array(
			'name'=>'workflow_date',
			'htmlOptions'=>array(
				'style'=>'width: 80px;'
			),
		),
		array(
			'name'=>'workflow_by',
			'htmlOptions'=>array(
				'style'=>'width: 120px;'
			),
		),
		array(
			'header'=>'Result',
			'value'=>'$data->workflowResult',
		),
		'workflow_remark',
		array(
				'class'=>'TbButtonColumn',
				'template'=>'{delete}',
				'deleteButtonUrl'=>'Yii::app()->createUrl("m1/gSelection/deleteSelection",array("id"=>$data->id))',
		),
		
		/*
		array(
				'class'=>'EJuiDlgsColumn',
				'template'=>'{update}{delete}',
				//'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
				'deleteButtonUrl'=>'Yii::app()->createUrl("m1/gSelection/deleteSelection",array("id"=>$data->id))',
				'updateDialog'=>array(
						'controllerRoute' => 'm1/gSelection/updateSelection',
						'actionParams' => array('id'=>'$data->id'),
						'dialogTitle' => 'Update Selection',
						'dialogWidth' => 512, //override the value from the dialog config
						'dialogHeight' => 530
				),
		),
		*/
	),
)); 
	
