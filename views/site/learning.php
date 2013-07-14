<?php
/* @var $this ILearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Learning Schedule',
);
?>

<div class="row">
    <div class="span8">
        <div class="page-header">
            <h1>
                <i class="icon-fa-book"></i>
                Learning Schedule
            </h1>
        </div>

        <?php
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
                'events' => Yii::app()->createUrl('/site/calendarEvents'), // action URL for dynamic events, or
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
        ?>

        <br/>

        <?php $this->renderPartial("_learningPhoto", array()) ?>

    </div>
    <div class="span4">
        <?php $this->renderPartial("/site/_category", array('category_id' => 1)) ?>
        <?php $this->renderPartial("/site/_category", array('category_id' => 2)) ?>
        <?php $this->renderPartial("/site/_category", array('category_id' => 3)) ?>
    </div>
</div>


<?php $this->renderPartial("_tabSocNet", array()) ?>

