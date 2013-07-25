<div class="page-header">
    <h1><i class="icon-fa-table"></i>
    Yii Log</h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'yii-log-grid',
    'dataProvider' => $dataProvider,
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}',
    'columns' => array(
        'logtime',
        'IP_user',
        'user_name',
        'request_URL',
        'message',
    ),
));
?>

