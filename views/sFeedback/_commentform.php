<div class="row">
    <div class="span7 offset1">
        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'id' => 'sFeedback-form',
            'type' => 'inline',
            'enableAjaxValidation' => false,
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textAreaRow($model, 'long_desc', array('class' => 'span8', 'rows' => 3, 'hint' => 'Input your Comment here...')); ?>

        <?php echo CHtml::htmlButton('<i class="icon-ok"></i> Reply', array('class' => 'btn', 'type' => 'submit')); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>

