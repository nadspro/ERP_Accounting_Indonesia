<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<div class="page-header">
    <h3>
        <i class="icon-fa-flag"></i>
        <?php
        echo "DashBoard";
        ?>
    </h3>
</div>



<div class="row">
    <div class="span12">
        <?php
        $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
                //'heading'=>'Welcome!!',
        ));
        ?>

        <p>Welcome to Process Production Module. This page has been reserved for
            future use. Thank you for using this product</p>

        <p>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'type' => 'primary',
                'size' => 'large',
                'label' => 'Learn more',
            ));
            ?>
        </p>

        <?php $this->endWidget(); ?>
    </div>
</div>

