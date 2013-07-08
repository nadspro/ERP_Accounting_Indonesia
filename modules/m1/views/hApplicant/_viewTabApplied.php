<?php if ($data->vacancyC != 0) { ?>
    <?php
    foreach ($data->vacancyMany as $list) {
        if (in_array($list->company_id, sUser::model()->getGroupArray())) {
            echo CHtml::tag('li', array(), CHtml::link($list->vacancy_title . " : " . $list->company->name, Yii::app()->createUrl('/m1/hVacancy/view', array('id' => $list->id)), array('target' => '_blank')));
        } else {
            echo CHtml::tag('li', array(), $list->vacancy_title . " : " . $list->company->name);
        }
    }
    ?>
    <br/>
<?php } ?>

