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
            <h1>Comparison By Profile</h1>
        </div>

        <div class="row">
            <div class="span6">
                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'chart' => array('defaultSeriesType' => 'column'),
                        'title' => array('text' => 'Employee Composition by Age'),
                        'theme' => 'dark-blue',
                        'xAxis' => array(
                            'categories' => array('<26', '26-30', '31-35', '36-40', '41-45', '46-50', '51-55', '>55')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => array(
                            array('name' => 'Age', 'data' => gPerson::compAge())
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
            <div class="span4">

                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'chart' => array('defaultSeriesType' => 'column'),
                        'title' => array('text' => 'Employee Composition by Gender'),
                        'xAxis' => array(
                            'categories' => array('Male', 'Female')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => array(
                            array('name' => 'Sex', 'data' => gPerson::compSex())
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
                        'title' => array('text' => 'Employee Composition by Religion'),
                        'xAxis' => array(
                            'categories' => array('Islam', 'Kr. Protestan', 'Kr. Katolik', 'Budha', 'Hindu', 'Kong Hu Cu')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => array(
                            array('name' => 'Religion', 'data' => gPerson::compReligion())
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
                        'title' => array('text' => 'Employee Composition by Education'),
                        'xAxis' => array(
                            'categories' => array('NE', 'SLTP', 'SLTA', 'Dipl', 'S1', 'S2', 'S3')
                        ),
                        'yAxis' => array(
                            'title' => array('text' => 'Total')
                        ),
                        'series' => array(
                            array('name' => 'Education', 'data' => gPerson::compEducation())
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

    </div>	
</div>

