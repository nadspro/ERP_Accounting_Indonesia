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
			<h1>Comparison By Department</h1>
		</div>
		
		<div class="row">
			<div class="span10">
				<?php 
					$this->Widget('ext.highcharts.HighchartsWidget', array(
					   'options'=>array(
						  'chart' => array('defaultSeriesType' => 'column'),
						  'title' => array('text' => 'Employee Composition by Department'),
						  'theme' => 'dark-blue',					  
						  'xAxis' => array(
							 'categories' => aOrganization::compDeptGroup(),
							 'labels'=> array( 
										'rotation'=> -90,
										'align'=> 'right',
							 ),		  
						  ),
						  'yAxis' => array(
							 'title' => array('text' => 'Total')
						  ),
						  'series' => array(
							 array('name' => 'Department', 'data' => gPerson::compDepartment())
						  ),
							'plotOptions'=> array (
								'column'=> array (
									'dataLabels'=> array (
										'enabled'=> true,
										'color'=> 'colors[0]',
										'style'=> array (
											'fontWeight'=> 'bold'
										),
									)
								)
							),
					   )
					));		
				?>
			</div>
			<div class="span5">
			.
			</div>
		</div>

	</div>	
</div>

