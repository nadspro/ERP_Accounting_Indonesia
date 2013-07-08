<?php
$this->breadcrumbs = array(
    'Selection' => array('index'),
);

$this->menu7 = hApplicant::model()->getTopRecentApplicant();

$this->menu = array(
    array('label' => 'Vacancy', 'icon' => 'home', 'url' => array('/m1/hVacancy')),
    array('label' => 'Applicant', 'icon' => 'user', 'url' => array('/m1/hApplicant')),
    array('label' => 'Selection Registration', 'icon' => 'tint', 'url' => array('/m1/jSelection')),
    array('label' => 'Interview', 'icon' => 'volume-up', 'url' => array('/m1/hVacancy/interview')),
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-tasks"></i>
        Selection Register
    </h1>
</div>

<?
$this->widget('ext.EFullCalendar.EFullCalendar', array(
    // polish version available, uncomment to use it
    // 'lang'=>'pl',
    // you can create your own translation by copying locale/pl.php
    // and customizing it
    // remove to use without theme
    // this is relative path to:
    // themes/<path>
    //'themeCssFile'=>'2jui-bootstrap/jquery-ui.css',
    // raw html tags
    'htmlOptions' => array(
        // you can scale it down as well, try 80%
        'style' => 'width:100%'
    ),
    // FullCalendar's options.
    // Documentation available at
    // http://arshaw.com/fullcalendar/docs/
    'options' => array(
        'header' => array(
            'left' => 'prev,next',
            'center' => 'title',
            'right' => 'today'
        ),
        //'lazyFetching'=>true,
        'events' => Yii::app()->createUrl('/m1/jSelection/calendarEvents'), // action URL for dynamic events, or
    //'events'=>array() // pass array of events directly
    // event handling
    // mouseover for example
    //'eventMouseover'=>new CJavaScriptExpression("js:function(event, element) {
    //			element.qtip({
    //				content: event.title
    //			}); 
    //	 } "),
    )
));

