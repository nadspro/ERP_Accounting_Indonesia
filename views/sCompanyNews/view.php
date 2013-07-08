<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = array(
    'Company News' => array('/sCompanyNews'),
    $model->title,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sCompanyNews')),
);

$this->menu1 = sCompanyNews::getTopUpdated();
$this->menu2 = sCompanyNews::getTopCreated();
?>

<div class="row">
    <div class="span8">
        <div class="page-header">
            <h1>
                <i class="iconic-article"></i>
                <?php echo $model->title; ?>
            </h1>
        </div>

        <?php
        echo "Posted By: " . $model->created->fullName2;
        echo "<br/>";
        echo "Posted Date: " . $model->publish_date;
        echo "<br/>";

        echo "<br/>";

        $this->beginWidget('CMarkdown', array('purifyOutput' => true));
        //echo strip_tags($model->content,"<a> <p>");
        echo $model->content;
        $this->endWidget();
        ?>

        <br/>
        <h6>Related Story:</h6>


    </div>
    <div class="span4">
        <?php $this->renderPartial("/site/_category", array('category_id' => 1)) ?>
        <?php $this->renderPartial("/site/_category", array('category_id' => 2)) ?>
        <?php $this->renderPartial("/site/_category", array('category_id' => 3)) ?>
    </div>
</div>

