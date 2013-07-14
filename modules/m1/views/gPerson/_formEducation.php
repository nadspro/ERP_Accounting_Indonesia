<div class="row">
    <div class="span9">

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'g-education-form',
            'enableAjaxValidation' => false,
                //'type'=>'horizontal',
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->dropDownListRow($model, 'level_id', sParameter::items('edu')); ?>

        <?php echo $form->textFieldRow($model, 'school_name', array('class' => 'span4')); ?>

        <?php echo $form->textFieldRow($model, 'interest', array()); ?>

        <?php echo $form->textFieldRow($model, 'city', array()); ?>

        <?php echo $form->textFieldRow($model, 'graduate', array('class' => 'span1')); ?>

        <?php echo $form->textFieldRow($model, 'ipk', array('class' => 'span1')); ?>

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

    </div>
</div>
