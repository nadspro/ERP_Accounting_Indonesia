<?php

$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'list',
    'items' => array(
        array('label' => 'HOME'),
        array('label' => 'Main Dashboard', 'icon' => 'leaf', 'url' => Yii::app()->createUrl("/m1/default")),
        array('label' => 'CURRENT DATA'),
        array('label' => 'Profile', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default/compByProfile")),
        array('label' => 'Career', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default/compByCareer")),
        array('label' => 'Department', 'icon' => 'th-large', 'url' => Yii::app()->createUrl("/m1/default/compByDepartment")),
        array('label' => 'DATA COMPLETION'),
        array('label' => 'Uncomplete Data', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/uncomplete")),
        array('label' => 'INFORMATION'),
        array('label' => 'Birthday', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/birthday")),
        array('label' => 'Probation/Contract', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/probationcontract")),
        array('label' => 'Employee In/Out', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/employeeinout")),
        array('label' => 'Black List', 'icon' => 'list', 'url' => Yii::app()->createUrl("/m1/default/blacklist")),
    ),
));
?>
