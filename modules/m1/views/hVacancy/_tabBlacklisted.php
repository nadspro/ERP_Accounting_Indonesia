<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => hVacancyApplicant::model()->search($model->id, 6),
    'template' => '{items}{pager}',
    'itemView' => '_tabList',
));
