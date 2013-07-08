<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-plane"></i>
        Extended Leave
    </h1>
</div>


<?php
echo $this->renderPartial('_formExtendedLeave', array('model' => $model));