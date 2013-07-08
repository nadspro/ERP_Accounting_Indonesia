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

    </div>
</div>

