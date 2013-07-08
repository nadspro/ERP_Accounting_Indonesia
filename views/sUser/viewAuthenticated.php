<?php
$this->breadcrumbs = array(
    $model->username,
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        <?php echo CHtml::encode($model->username); ?>
    </h1>
</div>

<?php echo $this->renderPartial('_userDetail', array('model' => $model)); ?>