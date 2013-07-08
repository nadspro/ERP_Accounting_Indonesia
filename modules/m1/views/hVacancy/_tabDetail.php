<?php

$this->widget('TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'company_name',
        array(
            'name' => 'industry.name',
            'label' => 'Industry'
        ),
        array(
            'name' => 'level.name',
            'label' => 'Level'
        ),
        array(
            'name' => 'spec.name',
            'label' => 'Specialization'
        ),
        'work_address',
        'work_area',
        'salary_currency',
        'salary_min',
        'salary_max',
        'min_work_exp',
        array(
            'name' => 'min_edulvl',
            'value' => $model->edulevel->name,
        ),
        'min_grade',
        'skill_required',
    ),
));

