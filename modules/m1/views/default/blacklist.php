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
            <h1>Employee In / Out</h1>
        </div>

        <div class="row">
            <div class="span5">
                <?php $this->renderPartial('_sbBlacklist'); ?>
            </div>
            <div class="span6">
                .
            </div>
        </div>
    </div>
</div>