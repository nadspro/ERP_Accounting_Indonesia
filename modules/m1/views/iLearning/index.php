<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'I Learnings',
);

$this->menu = array(
    array('label' => 'List By Subject', 'icon' => 'briefcase', 'url' => array('/m1/iLearning/index2')),
    array('label' => 'List By Date', 'icon' => 'briefcase', 'url' => array('/m1/iLearning/index3')),
    array('label' => 'Report', 'icon' => 'print', 'url' => array('/m1/iLearning/report')),
);

//$this->menu5=array('Sylabus');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-book"></i>
        Learning Schedule
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
        'events' => Yii::app()->createUrl('/m1/iLearning/calendarEvents'), // action URL for dynamic events, or
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

