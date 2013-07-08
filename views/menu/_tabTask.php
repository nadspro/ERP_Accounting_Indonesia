<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'stask-grid',
    'dataProvider' => sTask::model()->search(),
    //'filter'=>$model,
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => array(
        'message_id',
    ),
));
?>

<hr />


