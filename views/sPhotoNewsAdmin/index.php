<?php
$this->breadcrumbs = array(
);
?>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker2', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'datetime') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
		});
                            
                });

		");
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-picture"></i>
        Photo Managements
    </h1>
</div>


<ul class="nav nav-list">
    <li class="nav-header"><span class="h-icon-folder_database">Photo News Management</span>
    </li>
</ul>

<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', array(
    'connectorRoute' => 'sCompanyDocumentsAdmin/connectorPhotoDocumentsAdmin',
        )
);
?>

<h2>New Photo Album</h2>
<div class="row">
    <div class="span9">

        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'module-matrix-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'datetime', array('class' => 'span2')); ?>

        <?php echo $form->textFieldRow($model, 'title', array('class' => 'span5')); ?>

        <?php //echo $form->textAreaRow($model,'description',array('class'=>'span7','rows'=>3,'hint'=>'Maximum 5000 characters'));  ?>
        <?php
        echo $form->html5EditorRow($model, 'description', array(
            'class' => 'span7', 'rows' => 5, 'height' => '200', 'options' => array('color' => true)));
        ?>

        <div class="control-group">
            <label class="control-label required">Upload Files</label>
            <div class="controls">
                <?php
                $this->widget('CMultiFileUpload', array(
                    'model' => $model,
                    'attribute' => 'images',
                    'accept' => 'jpg',
                    'options' => array(
                    ),
                ));
                ?>
            </div>
        </div>


        <?php /*
          <?php $this->widget('bootstrap.widgets.TbFileUpload', array(
          'url' => $this->createUrl("sPhotoNewsAdmin/upload"),
          'model' => $model,
          'attribute' => 'images', // see the attribute?
          'multiple' => true,
          'options' => array(
          'maxFileSize' => 2000000,
          'acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i',
          ))); ?>

         */ ?>


        <div class="form-actions">
            <?php echo CHtml::htmlButton('<i class="icon-ok"></i> Upload', array('class' => 'btn', 'type' => 'submit')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
