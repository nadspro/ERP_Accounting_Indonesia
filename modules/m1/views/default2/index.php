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
                        'xAxis' => array(
                            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                        ),
                        'theme' => 'dark-blue',
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => gPerson::compEmployeePerMonthAll(),
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
                        'title' => array('text' => 'Employee In and Out per Month (' . date("Y") . ')'),
                        'xAxis' => array(
                            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => gPerson::compEmployeeInAll(),
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

        <?php /*

          <div class="row">
          <div class="span10">
          <?php
          $this->Widget('ext.highcharts.HighchartsWidget', array(
          'options'=>array(
          'chart' => array('defaultSeriesType' => 'column'),
          'title' => array('text' => '#Dummy DATA# P-D-M per Month ('.date("Y").')'),
          'xAxis' => array(
          'categories' => array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des')
          ),
          'yAxis' => array(
          'title' => array('text' => 'Total')
          ),
          //'series'=>jSelectionPart::compSelectionPerMonth(),
          'series' => array(
          array('name' => 'Promotion', 'data' => array(1, 0, 4,5,6,7,3,5,4,5,9,10)),
          array('name' => 'Demotion', 'data' => array(2, 6, 3,4,5,6,8,7,9,11,12,10)),
          array('name' => 'Mutation', 'data' => array(5, 7, 3,7,4,3,2,1,2,3,2,1)),
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
          </div>

          <br/>
         */ ?>

        <div class="row">
            <div class="span5">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'chart' => array('defaultSeriesType' => 'line'),
                        'title' => array('text' => 'Recruitment Readiness per Month (' . date("Y") . ')'),
                        'xAxis' => array(
                            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => hApplicant::compApplicantPerMonth(),
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
                        'title' => array('text' => 'Jobs Opening per Month (' . date("Y") . ')'),
                        'xAxis' => array(
                            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => hVacancy::compVacancyPerMonth(),
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
                        'chart' => array('defaultSeriesType' => 'line'),
                        'title' => array('text' => 'Training Aggressivity per Month (' . date("Y") . ')'),
                        'xAxis' => array(
                            'categories' => array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => iLearningSch::compLearningHoursPerMonth(),
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
                        'series' => iLearningSch::compLearningClassPerMonth(),
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

