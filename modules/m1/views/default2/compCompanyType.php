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
            <h1>Comparison Based on Company Type</h1>
        </div>

        <?php
        $this->Widget('ext.highcharts.HighchartsWidget', array(
            'options' => array(
                'chart' => array('defaultSeriesType' => 'column'),
                'title' => array('text' => 'Employee Composition (Holding)'),
                'xAxis' => array(
                    'categories' => aOrganization::compByParent(971),
                    'labels' => array(
                        'rotation' => -90,
                        'align' => 'right',
                    ),
                ),
                'yAxis' => array(
                    'title' => array('text' => 'Total')
                ),
                'series' => array(
                    array('name' => 'Project', 'data' => gPerson::proEmployee(971))
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
            'htmlOptions' => array(
                'style' => 'height:800px',
            )
        ));
        ?>

        <?php
        $this->Widget('ext.highcharts.HighchartsWidget', array(
            'options' => array(
                'chart' => array('defaultSeriesType' => 'column'),
                'title' => array('text' => 'Employee Composition (Developer)'),
                'xAxis' => array(
                    'categories' => aOrganization::compByParent(669),
                    'labels' => array(
                        'rotation' => -90,
                        'align' => 'right',
                    ),
                ),
                'yAxis' => array(
                    'title' => array('text' => 'Total'),
                ),
                'series' => array(
                    array('name' => 'Project', 'data' => gPerson::proEmployee(669))
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
            'htmlOptions' => array(
                'style' => 'height:800px',
            )
        ));
        ?>

        <?php
        $this->Widget('ext.highcharts.HighchartsWidget', array(
            'options' => array(
                'chart' => array('defaultSeriesType' => 'column'),
                'title' => array('text' => 'Employee Composition (POM)'),
                'xAxis' => array(
                    'categories' => aOrganization::compByParent(670),
                    'labels' => array(
                        'rotation' => -90,
                        'align' => 'right',
                    ),
                ),
                'yAxis' => array(
                    'title' => array('text' => 'Total')
                ),
                'series' => array(
                    array('name' => 'Project', 'data' => gPerson::proEmployee(670))
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
            'htmlOptions' => array(
                'style' => 'height:800px',
            )
        ));
        ?>
    </div>
</div>
</div>

