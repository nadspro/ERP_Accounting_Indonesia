<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => hVacancyApplicant::model()->search($model->id, 3),
    'template' => '{items}{pager}',
    'itemView' => '_tabList',
));

