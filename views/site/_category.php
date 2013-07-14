<?php
$models = sCompanyNews::model()->getCategory($category_id);

if ($models) {
    ?>

    <?php
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => $models[0]->category->category_name,
        'headerIcon' => 'icon-fa-globe',
        'htmlHeaderOptions' => array('style' => 'border-radius:4px'),
        'htmlContentOptions' => array('style' => 'border:none;padding-top:0'),
    ));
    ?>



    <?php foreach ($models as $model) { ?>
        <?php //echo CHtml::image(Yii::app()->request->baseUrl . "/shareimages/company/FA-logo-APL-mini.jpg", 'logo', array("class"=>"media-object")); ?>
        <h5>
            <?php echo CHtml::link(CHtml::encode($model->title), Yii::app()->createUrl('/sCompanyNews/view', array("id" => $model->id))); ?>
        </h5>

        <strong><?php echo date('d-m-Y', strtotime($model->publish_date)); ?>: </strong>

        <?php echo peterFunc::shorten_string(strip_tags($model->content), 40); ?>

    <?php } ?>


    <?php $this->endWidget(); ?>

    <?php
}
