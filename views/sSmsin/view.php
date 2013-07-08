<?php
$this->breadcrumbs = array(
    'SMS' => array('index'),
    $model->id,
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-phone"></i>
        <?php echo CHtml::encode($model->cfrom); ?>
    </h1>
</div>


<?php
//$this->widget('bootstrap.widgets.TbDetailView', array(
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'filename',
        'cfrom',
        'sent',
        'received',
        'modem',
        'message',
        'reply_id',
    ),
));
?>
