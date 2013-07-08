<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<div class="row">
    <div class="span2">
        <?php echo $this->renderPartial('_menuNavigation'); ?>
    </div>

    <div class="span10">
        <div class="page-header">
            <h1>Probation / Contract
                <small>Data displayed from last 60 days or expired</small>
            </h1>
        </div>


        <div class="row">
            <div class="span5">
                <?php $this->renderPartial('_sbProbation'); ?>
            </div>
            <div class="span5">
                <?php $this->renderPartial('_sbContract'); ?>
            </div>
        </div>
    </div>
</div>