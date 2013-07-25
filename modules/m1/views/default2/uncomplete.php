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
            <h1>Uncomplete Data</h1>
        </div>

        <div style="width:100%">
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options' => array(
                    'chart' => array('defaultSeriesType' => 'column'),
                    'title' => array('text' => 'Basic Profile'),
                    'theme' => 'dark-blue',
                    'xAxis' => array(
                        'categories' => gPerson::getUncompleteHoldingCompany(),
                        'labels' => array(
                            'rotation' => -90,
                            'align' => 'right',
                        ),
                    ),
                    'yAxis' => array(
                        'title' => array('text' => 'Total')
                    ),
                    'series' => array(
                        array('name' => 'Company', 'data' => gPerson::getUncompleteHolding("basic"))
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
            <br/>
        </div>

        <div style="width:100%">
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options' => array(
                    'chart' => array('defaultSeriesType' => 'column'),
                    'title' => array('text' => 'Education'),
                    'xAxis' => array(
                        'categories' => gPerson::getUncompleteHoldingCompany(),
                        'labels' => array(
                            'rotation' => -90,
                            'align' => 'right',
                        ),
                    ),
                    'yAxis' => array(
                        'title' => array('text' => 'Total')
                    ),
                    'series' => array(
                        array('name' => 'Company', 'data' => gPerson::getUncompleteHolding("education"))
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
            <br/>
        </div>

        <div style="width:100%">
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options' => array(
                    'chart' => array('defaultSeriesType' => 'column'),
                    'title' => array('text' => 'Family'),
                    'xAxis' => array(
                        'categories' => gPerson::getUncompleteHoldingCompany(),
                        'labels' => array(
                            'rotation' => -90,
                            'align' => 'right',
                        ),
                    ),
                    'yAxis' => array(
                        'title' => array('text' => 'Total')
                    ),
                    'series' => array(
                        array('name' => 'Company', 'data' => gPerson::getUncompleteHolding("family"))
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
            <br/>
        </div>

        <div style="width:100%">
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options' => array(
                    'chart' => array('defaultSeriesType' => 'column'),
                    'title' => array('text' => 'Experience'),
                    'xAxis' => array(
                        'categories' => gPerson::getUncompleteHoldingCompany(),
                        'labels' => array(
                            'rotation' => -90,
                            'align' => 'right',
                        ),
                    ),
                    'yAxis' => array(
                        'title' => array('text' => 'Total')
                    ),
                    'series' => array(
                        array('name' => 'Company', 'data' => gPerson::getUncompleteHolding("experience"))
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
            <br/>
        </div>

        <div style="width:100%">
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options' => array(
                    'chart' => array('defaultSeriesType' => 'column'),
                    'title' => array('text' => 'Education Non Formal'),
                    'xAxis' => array(
                        'categories' => gPerson::getUncompleteHoldingCompany(),
                        'labels' => array(
                            'rotation' => -90,
                            'align' => 'right',
                        ),
                    ),
                    'yAxis' => array(
                        'title' => array('text' => 'Total')
                    ),
                    'series' => array(
                        array('name' => 'Company', 'data' => gPerson::getUncompleteHolding("educationnf"))
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
            <br/>
        </div>

        <div style="width:100%">
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options' => array(
                    'chart' => array('defaultSeriesType' => 'column'),
                    'title' => array('text' => 'Other Info'),
                    'xAxis' => array(
                        'categories' => gPerson::getUncompleteHoldingCompany(),
                        'labels' => array(
                            'rotation' => -90,
                            'align' => 'right',
                        ),
                    ),
                    'yAxis' => array(
                        'title' => array('text' => 'Total')
                    ),
                    'series' => array(
                        array('name' => 'Company', 'data' => gPerson::getUncompleteHolding("other"))
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
            <br/>
        </div>
    </div>

