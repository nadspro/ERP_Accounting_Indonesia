<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-hand-up"></i>
        <?php echo "Update Permission: " . $model->employee_name; ?>
    </h1>
</div>

<?php
echo $this->renderPartial('_formPermission', array('model' => $modelPermission));
