<?php

$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'list',
    'items' => array(
        array('label' => 'HOME'),
        array('label' => 'Main Dashboard', 'icon' => 'leaf', 'url' => Yii::app()->createUrl("/m1/default2")),
        array('label' => 'COMPARISON'),
        array('label' => 'Total Employee', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default2/compTotalEmployee")),
        array('label' => 'By Company Type', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default2/compCompanyType")),
        array('label' => 'Total Employee', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default2/compTotalEmployee")),
        array('label' => 'Other', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default2/compTotalEmployee")),
        array('label' => 'DATA COMPLETION'),
        array('label' => 'Uncomplete Data', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default2/uncomplete")),
    ),
));
?>
