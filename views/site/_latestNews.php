<?php
$models = sCompanyNews::model()->latestNews;

if ($models) {
    ?>

    <?php
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => false,
        'headerIcon' => 'icon-globe',
        'htmlHeaderOptions' => array('style' => 'background:white'),
        'htmlContentOptions' => array('style' => 'background:#E9E9E9'),
    ));
    ?>

    <h4><i class="iconic-article"></i> Latest Article</h4>
    <?php foreach ($models as $model) { ?>
        <strong><?php echo CHtml::link(CHtml::encode($model->title), Yii::app()->createUrl('/sCompanyNews/view', array("id" => $model->id))); ?></strong>
        <?php //echo date('d-m-Y',$data->created_date); ?>
        <?php
        $this->beginWidget('CMarkdown', array('purifyOutput' => true));
        $_desc = peterFunc::shorten_string(strip_tags($model->content), 10);
        echo $_desc;
        $this->endWidget();
        ?>

    <?php } ?>

    <?php $this->endWidget(); ?>

    <?php
}