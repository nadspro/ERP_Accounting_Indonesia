<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-planet"></i>
        <?php echo "Update Leave: " . $model->employee_name; ?>
    </h1>
</div>


<?php
echo $this->renderPartial('_formLeave', array('model' => $modelLeave));
