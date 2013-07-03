<h4>Application</h4>

<?php $this->widget('TbGridView', array(
		'id'=>'g-vacancy-grid',
		'dataProvider'=>hVacancyApplicant::model()->searchByApplicant($model->id),
		//'filter'=>$model,
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
					'header'=>'Apply Date',
					'value'=>'date("d-m-Y",$data->created_date)',
				),
				array(
					'header'=>'Vacancy Title',
					'type'=>'raw',
					'value'=>'CHtml::link($data->vacancy->vacancy_title." - ".$data->vacancy->company->name,Yii::app()->createUrl("/m1/hVacancy/view",array("id"=>$data->vacancy->id))) ',
				),
				//array(
				//	'header'=>'Vacancy Title',
				//	'type'=>'raw',
					//'value'=>'$data->vacancy->vacancy_title." - ".$data->vacancy->company->name',
					//'value'=>'$data->vacancy->company_id',
					//'value'=>'print_r(sUser::model()->getGroupArray())',
					//'value'=>'in_array($data->vacancy->company_id,sUser::model()->getGroupArray())',
				//),
				array(
					'header'=>'Applicant Status',
					'value'=>'$data->status->name',
				),
		),
)); ?>

<h4>Comment</h4>

<?php $this->widget('TbGridView', array(
		'id'=>'g-selection-grid',
		'dataProvider'=>hApplicantComment::model()->search($model->id),
		//'filter'=>$model,
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
					'header'=>'Apply Date',
					'value'=>'date("d-m-Y",$data->created_date)',
				),
				array(
					'header'=>'User',
					'value'=>'$data->user->username',
				),
				'comment',
		),
)); ?>

<h4>Selection Schedule</h4>

<?php $this->widget('TbGridView', array(
		'id'=>'g-selection-grid',
		'dataProvider'=>jSelectionPart::model()->searchByEmp($model->id),
		//'filter'=>$model,
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
					'header'=>'Created',
					'value'=>'date("d-m-Y",$data->created_date)',
				),
				'company.name',
				'department.name',
				'for_position',
				array(
					'header'=>'Level',
					'value'=>'$data->level->name',
				),
		),
)); ?>

<h4>Selection Result</h4>

<?php $this->widget('TbGridView', array(
		'id'=>'g-selection-grid',
		'dataProvider'=>hApplicantSelection::model()->search($model->id),
		//'filter'=>$model,
		'template'=>'{items}{pager}',
		'columns'=>array(
				'workflow_by',
				'assestment_date',
				array(
					'header'=>'Work Flow',
					'value'=>'$data->workflow->name',
				),
				array(
					'header'=>'Work Flow Result',
					'value'=>'$data->workflow_result_id',
				),
				'assestment_summary',
				'development_area',
		),
)); ?>
