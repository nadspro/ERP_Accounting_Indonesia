<?php
$model = sCompanyNews::model()->fullArticle;
if ($model) {
    ?>


    <?php
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => false,
        'headerIcon' => 'icon-globe',
    ));
    ?>

    <div class="page-header">
        <h2><?php echo $model->title; ?></h2>
    </div>

    <div class="small">
        <?php
        echo "by " . $model->created->username;
        echo " on  " . date('d-m-Y', $model->created_date);
        ?>
    </div>

    <?php
    echo "<br/>";
    $this->beginWidget('CMarkdown', array('purifyOutput' => true));
    echo $model->content;
    $this->endWidget();
    ?>

    <br/>
    <h6>Related Story:</h6>

    <?php $this->endWidget(); ?>

    <?php
}
