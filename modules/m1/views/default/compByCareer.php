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
            <h1>Comparison By Career</h1>
        </div>

        <div class="row">
            <div class="span5">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'chart' => array('defaultSeriesType' => 'column'),
                        'title' => array('text' => 'Employee Composition by Service Years'),
                        'theme' => 'dark-blue',
                        'xAxis' => array(
                            'categories' => array('<1', '1-2', '3-4', '5-6', '7-8', '>8')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => array(
                            array('name' => 'Working Years', 'data' => gPerson::compWorking())
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
                    )
                ));
                ?>
            </div>
            <div class="span5">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'chart' => array('defaultSeriesType' => 'column'),
                        'title' => array('text' => 'Employee Composition by Level'),
                        'xAxis' => array(
                            'categories' => array('Pelaksana', 'Officer', 'Supervisor', 'Manager', 'General Manager', 'Vice President')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => array(
                            array('name' => 'Level', 'data' => gPerson::compLevel())
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
                    )
                ));
                ?>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="span5">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'chart' => array('defaultSeriesType' => 'column'),
                        'title' => array('text' => 'Employee Composition by Status'),
                        'xAxis' => array(
                            'categories' => array('Contract', 'Probation', 'Permanent', 'Daily Worker')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => array(
                            array('name' => 'Status', 'data' => gPerson::compStatus())
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

