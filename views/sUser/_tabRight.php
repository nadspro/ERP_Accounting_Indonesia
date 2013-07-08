<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'mat-user-module-grid1',
    'dataProvider' => sUser::model()->userRight($model->id),
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'template' => '{items}{pager}',
    'columns' => array(
        'itemname',
    )
));
?>