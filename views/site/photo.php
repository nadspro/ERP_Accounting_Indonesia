<?php
$this->breadcrumbs = array(
    'Photo News' => array('/site/photo'),
);
?>


<?php
$dir = Yii::app()->basePath . "/../shareimages/photo";
$contents = scandir($dir, 1);
$counter = 1;
?>

<div class="row">
    <div class="span9">

        <?php /*
          $dependency = new CDirectoryCacheDependency(Yii::app()->basePath.'/../shareimages/photo/');

          if (!Yii::app()->cache->get('photolist')) {
          $photoList=$this->renderPartial("_photoRender",array('contents'=>$contents,'dir'=>$dir,'counter'=>$counter),true);

          Yii::app()->cache->set('photolist'.Yii::app()->user->id,$photoList,86400,$dependency);
          } else
          $photoList=Yii::app()->cache->get('photolist');

          echo $photoList;
         */ ?>

        <?php
        $this->widget('ext.albumPhoto', array('dir' => Yii::app()->basePath . "/../shareimages/photo",
            'columns' => 3,
            'span' => 3
        ));
        ?>


    </div>
    <div class="span3">
        <?php $this->renderPartial("_category", array('category_id' => 1)) ?>
        <?php //$this->renderPartial("_category",array('category_id'=>2)) ?>
        <?php $this->renderPartial("_category", array('category_id' => 3)) ?>
    </div>

    <div class="pull-right">
        <p>
            <strong><?php echo CHtml::link('News Index', Yii::app()->createUrl('/sCompanyNews')); ?></strong>				
        </p>
    </div>

</div>


<?php $this->renderPartial("_tabSocNet", array()) ?>
