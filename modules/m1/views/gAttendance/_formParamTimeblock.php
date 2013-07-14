<?php
/* @var $this GParamTimeblockController */
/* @var $model gParamTimeblock */
/* @var $form CActiveForm */
?>

<div class="row">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'g-param-timeblock-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
    ));
    ?>


    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'code', array('size' => 25, 'maxlength' => 25)); ?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'in', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $this->widget(
                    'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'in',
                'options' => array(
                    'timeOnly' => true,
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                ),
                    )
            );
            ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'out', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $this->widget(
                    'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'out',
                'options' => array(
                    'timeOnly' => true,
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                ),
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'rest_in', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $this->widget(
                    'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'rest_in',
                'options' => array(
                    'timeOnly' => true,
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                ),
                    )
            );
            ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'rest_out', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $this->widget(
                    'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'rest_out',
                'options' => array(
                    'timeOnly' => true,
                    'timeFormat' => 'hh:mm', //'hh:mm tt' default
                ),
                    )
            );
            ?>
        </div>
    </div>
    <?php echo $form->textAreaRow($model, 'remark', array('class' => 'span3', 'rows' => 3)); ?>

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