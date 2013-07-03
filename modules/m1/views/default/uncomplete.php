<?php
$this->breadcrumbs=array(
		$this->module->id,
);
?>

<div class="row">
	<div class="span2">
		<?php echo $this->renderPartial('_menuNavigation'); ?>
	</div>

	<div class="span10">
		<div class="page-header">
			<h1>Employee In / Out</h1>
		</div>
		

		<?php $this->widget('ext.bootstrap.widgets.TbGridView', array(
				'id'=>'abudget-grid',
				'dataProvider'=>gPerson::model()->getUncomplete(),
				'itemsCssClass'=>'table table-striped table-bordered',
				'template'=>'{items}{pager}',
				//'filter'=>$model,
				'columns'=>array(
						array(
							'header'=>'Components',
							'value'=>'$data["components"]',
						),
						array(
							'header'=>'Completion (%)',
							'value'=>'number_format($data["t_total"] / $data["t_count"] * 100,2)',
						),
						array(
								'class' => 'ext.TbProgressColumn',
								//'name' => 'percentage',
								//'value'=>'$data->amount',
								'percent' => 100,
								'value'=>'number_format($data["t_total"] / $data["t_count"] * 100,2)',
								'htmlOptions'=>array('style'=>'width: 200px;'),
						),
				),
		)); ?>





		<h3>List of Uncomplete Data</h3>
		<?php /*

		<?php $this->widget('bootstrap.widgets.TbGridView',array(
				'id'=>'g-karir-grid',
				'dataProvider'=>gPerson::model()->uncompleteList(),
				//'filter'=>$model,
				'template'=>'{items}{pager}',
				'columns'=>array(
					array(
						'name'=>'employee_name',
						'type'=>'raw',
						'value'=>'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPerson/view",array("id"=>$data->id)),array("target"=>"_blank"))',
					),
					array(
						'class' => 'bootstrap.widgets.TbEditableColumn',
						'name' => 'birth_place',
						'sortable'=>false,
						'editable' => array(
							'url'     => $this->createUrl('/m1/gPerson/updatePersonAjax'),
							//'placement' => 'right',
							'inputclass' => 'span2'
					)),
					'birth_date',
					array(
						'class' => 'bootstrap.widgets.TbEditableColumn',
						'name' => 'address1',
						'sortable'=>false,
						'editable' => array(
							'type'=>'textarea',
							'url'     => $this->createUrl('/m1/gPerson/updatePersonAjax'),
							//'placement' => 'right',
							'inputclass' => 'span3'
					)),
					array(
						'class' => 'bootstrap.widgets.TbEditableColumn',
						'name' => 'identity_number',
						'sortable'=>false,
						'editable' => array(
							'url'     => $this->createUrl('/m1/gPerson/updatePersonAjax'),
							//'placement' => 'right',
							'inputclass' => 'span3'
					)),
					'identity_valid',
					array(
						'class' => 'bootstrap.widgets.TbEditableColumn',
						'name' => 'identity_address1',
						'sortable'=>false,
						'editable' => array(
							'type'=>'textarea',
							'url'     => $this->createUrl('/m1/gPerson/updatePersonAjax'),
							//'placement' => 'right',
							'inputclass' => 'span3'
					)),
					//'handphone',
					//'c_pathfoto',
					//'account_number',
					//'bank_name',
					//'account_name',
				),
		)); ?>

		*/ ?>
		<p>A = Birth Place | B = Birth Date | C = Address | D = Identity Number |
		E = Identity Valid | F = Identity Address | G = Handphone | H = Photo | I = Account Number
		J = Account Name | K = Bank Name
		</p>

		<?php $this->widget('bootstrap.widgets.TbGridView',array(
				'id'=>'g-karir-grid',
				'dataProvider'=>gPerson::model()->uncompleteList(),
				//'filter'=>$model,
				'template'=>'{items}{pager}',
				'columns'=>array(
					array(
						'name'=>'employee_name',
						'type'=>'raw',
						'value'=>'CHtml::link($data->employee_name,Yii::app()->createUrl("/m1/gPerson/view",array("id"=>$data->id)),array("target"=>"_blank"))',
					),
					array(
						'header'=>'Department',
						'value' => '$data->mDepartment()',
					),
					array(
						'header'=>'Job Title',
						'value' => '$data->mJobTitle()',
					),
					array(
						'header' => 'A',
						'value' => '(isset($data->birth_place)) ? "O":""',
					),
					array(
						'header' => 'B',
						'value' => '(isset($data->birth_date)) ? "O":""',
					),
					array(
						'header' => 'C',
						'value' => '(isset($data->address1)) ? "O":""',
					),
					array(
						'header' => 'D',
						'value' => '(isset($data->identity_number)) ? "O":""',
					),
					array(
						'header' => 'E',
						'value' => '(isset($data->identity_valid)) ? "O":""',
					),
					array(
						'header' => 'F',
						'value' => '(isset($data->identity_address)) ? "O":""',
					),
					array(
						'header' => 'G',
						'value' => '(isset($data->handphone)) ? "O":""',
					),
					array(
						'header' => 'H',
						'value' => '(isset($data->c_pathfoto)) ? "O":""',
					),
					array(
						'header' => 'I',
						'value' => '(isset($data->account_number)) ? "O":""',
					),
					array(
						'header' => 'J',
						'value' => '(isset($data->account_name)) ? "O":""',
					),
					array(
						'header' => 'K',
						'value' => '(isset($data->bank_name)) ? "O":""',
					),
		/*			array(
						'header' => 'Education',
						'value' => 'if (count($data->many_education) != 0 ? "";"X"  ',
					),
					array(
						'header' => 'Family',
						'value' => 'if (count($data->many_family) != 0 ? "";"X"  ',
					),
					array(
						'header' => 'Experience',
						'value' => 'if (count($data->many_experience) != 0 ? "";"X"  ',
					),
					array(
						'header' => 'Education Non Formal',
						'value' => 'if (count($data->many_educationnf) != 0 ? "";"X"  ',
					),
					array(
						'header' => 'Education Other',
						'value' => 'if (count($data->many_other) != 0 ? "";"X"  ',
					),
		*/
				),
		)); 
		?>
	</div>
</div>



