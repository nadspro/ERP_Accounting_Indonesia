<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'gperson-training-nf-grid',
	'dataProvider'=>iLearningSchPart::model()->searchByEmployee($model->id),
	//'filter'=>$model,
	'template'=>'{items}',
	'columns'=>array(
		'getparent.getparent.learning_title',
		'getparent.schedule_date',
		'getparent.trainer_name',
		'getparent.getparent.duration',
		'getparent.location',
		'resultFeedback',
	),
)); 

