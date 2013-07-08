<div style="width:100%">
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
    <br/>

</div>