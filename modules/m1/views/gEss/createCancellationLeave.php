<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-plane"></i>
        Create Cancellation Leave
    </h1>
</div>


<?php
echo $this->renderPartial('_formCancellationLeave', array('model' => $model));