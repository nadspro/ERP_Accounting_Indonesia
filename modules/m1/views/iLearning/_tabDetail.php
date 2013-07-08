<?php

$this->widget('ext.bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'objective',
        'outline',
        'participant',
        'duration',
        array(
            'name' => 'type_id',
            'value' => $model->type->name,
        ),
    ),
));

