<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>


<?php
echo $this->renderPartial('_formPerson', array('model' => $model));