<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-plane"></i>
        Create Leave
    </h1>
</div>


<?php
echo $this->renderPartial('_formLeave', array('model' => $model));