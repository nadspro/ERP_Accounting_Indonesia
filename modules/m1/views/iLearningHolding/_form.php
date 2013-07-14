<?php
/* @var $this ILearningController */
/* @var $model iLearning */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="span9">

        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'i-learning-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model, 'learning_title', array('class' => 'span5')); ?>
        <?php echo $form->textAreaRow($model, 'objective', array('class' => 'span7', 'rows' => 8)); ?>
        <?php echo $form->textAreaRow($model, 'outline', array('class' => 'span7', 'rows' => 8)); ?>
        <?php echo $form->textFieldRow($model, 'participant', array('class' => 'span4')); ?>
        <?php echo $form->textFieldRow($model, 'duration', array('class' => 'span1')); ?>
        <?php echo $form->dropDownListRow($model, 'type_id', sParameter::items('cTraining')); ?>
        <?php echo $form->dropDownListRow($model, 'prerequisites_id', iLearning::model()->sylabusList()); ?>

        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ));
            ?>

        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div><!-- form -->