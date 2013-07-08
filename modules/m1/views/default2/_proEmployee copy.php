<div class="row">
    <div class="span5">
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
    <div class="span5">
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

<div class="row">
    <div class="span5">
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

    </div>
    <div class="span5">
        Reserved
    </div>
</div>

<div class="row">
    <div class="span10">
        <?php
        $this->Widget('ext.highcharts.HighchartsWidget', array(
            'options' => array(
                'chart' => array('defaultSeriesType' => 'line'),
                'title' => array('text' => 'Total Employee per Month (' . date("Y") . ')'),
                'xAxis' => array(
                    'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                ),
                'yAxis' => array(
                    'title' => array('text' => 'Total')
                ),
                /* 		  'series' => array(
                  array('name' => 'Tenant', 'data' => array(1,3,2,3,2,1,2,0,2,3,1,0)),
                  array('name' => 'BOD', 'data' => array(0,0,1,2,1,0,0,1,1,2,1,1))
                  ),
                 */ 'series' => gPerson::compEmployeePerMonthAll(),
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

<div class="row">
    <div class="span10">
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
    </div>
</div>

<div class="row">
    <div class="span10">
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