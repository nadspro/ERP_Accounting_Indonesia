<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-calendar"></i><?php echo Yii::t('basic', ' Corporate Calendar') ?></span>
        </li>
    </ul>
</div>

<div>
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
            'events' => Yii::app()->createUrl('/menu/calendarEvents'), // action URL for dynamic events, or
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
</div>
<br/>
<br/>