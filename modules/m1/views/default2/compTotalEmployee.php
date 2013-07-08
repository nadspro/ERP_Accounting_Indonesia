<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<div class="row">
    <div class="span2">
        <?php echo $this->renderPartial('_menuNavigation'); ?>
    </div>

    <div class="span10">
        <div class="page-header">
            <h1>Comparison Based on Employee</h1>
        </div>


        <div class="row">
            <div class="span6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'title' => array('text' => 'Total Employee Composition'),
                        'series' => array(
                            array('type' => 'pie', 'name' => 'Project', 'data' => gPerson::holdingTotal())
                        ),
                        'plotOptions' => array(
                            'pie' => array(
                                'dataLabels' => array(
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'formatter' => "js:function() {
										return '<b>'+ this.point.name +'</b>: '+ parseFloat(this.percentage).toFixed(1) +' %';
									}"
                                )
                            )
                        ),
                    ),
                ));
                ?>
            </div>
            <div class="span4">

                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'chart' => array('defaultSeriesType' => 'column'),
                        'title' => array('text' => 'Total Employee'),
                        'yAxis' => array(
                            'title' => array('text' => 'Total Employee')
                        ),
                        'xAxis' => array(
                            'categories' => array('Current'),
                        ),
                        'series' => array(
                            array('name' => 'Total', 'data' => gPerson::grandTotal())
                        ),
                        'plotOptions' => array(
                            'column' => array(
                                'dataLabels' => array(
                                    'enabled' => true,
                                    'color' => 'colors[0]',
                                    'style' => array(
                                        'fontWeight' => 'bold'
                                    ),
                                )
                            )
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>	
</div>

