<?php
//$this->widget('bootstrap.widgets.TbDetailView', array(
$this->widget('ext.XDetailView', array(
    'ItemColumns' => 1,
    'data' => $model,
    'attributes' => array(
        'full_name',
        'username',
        //'password',
        array(
            'label' => 'Default Group',
            'value' => aOrganization::model()->findByPk($model->default_group)->name,
        ),
        array(
            'label' => 'Status',
            'value' => $model->status->name,
        ),
    ),
));
?>
<br />
