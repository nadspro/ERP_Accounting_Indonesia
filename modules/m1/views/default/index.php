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
            <h1>Main Dashboard</h1>
        </div>

        <div class="row">
            <div class="span5">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'chart' => array('defaultSeriesType' => 'line'),
                        'title' => array('text' => 'Total Employee per Month (' . date("Y") . ')'),
                        'theme' => 'dark-blue',
                        'xAxis' => array(
                            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => gPerson::compEmployeePerMonth(),
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
                        'title' => array('text' => 'Employee In and Out by Month (' . date("Y") . ')'),
                        'xAxis' => array(
                            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => gPerson::compEmployeeIn(),
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
        <?php /*
        <br/>

        <div class="row">
            <div class="span5">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'chart' => array('defaultSeriesType' => 'line'),
                        'title' => array('text' => 'Training Aggressivity per Month (' . date("Y") . ')'),
                        'xAxis' => array(
                            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => iLearningSch::compLearningHoursPerMonthPerBu(),
                        //'series' => array(
                        //	 array('name' => 'Total Hours', 'data' => array(500, 550, 625,700,1000,1250,1750,1800,2000,2220,2400,2700)),
                        //),
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
                        'title' => array('text' => 'Total Participant and Class per Month (' . date("Y") . ')'),
                        'xAxis' => array(
                            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => iLearningSch::compLearningClassPerMonthPerBu(),
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
        */ ?>

    </div>
</div>

