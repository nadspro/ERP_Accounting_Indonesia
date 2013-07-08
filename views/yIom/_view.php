<?php
/* @var $this SCompanyNewsController */
/* @var $data SCompanyNews */
?>

<div class="row">
    <div class="span9">
        <h4>
            <?php echo CHtml::link(CHtml::encode($data->subject), Yii::app()->createUrl('/sCompanyNews/view', array('id' => $data->id))); ?>
        </h4>
    </div>	
</div>	

<div class="row">
    <div class="span1">
        <?php echo CHtml::image(Yii::app()->request->baseUrl . "/shareimages/company/logo_ONLY.jpg", CHtml::encode($data->id), array("width" => "100%")); ?>
    </div>
    <div class="span8">
        <?php echo date('d-m-Y', strtotime($data->iom_date)); ?>
        <br />
        <?php
        $this->beginWidget('CMarkdown', array('purifyOutput' => true));
        $_desc = $data->content ? substr($data->content, 0, 420) . "..." . "</p>" : "";
        echo $_desc;
        $this->endWidget();
        ?>
        <br />
        <br />
    </div>
</div>
