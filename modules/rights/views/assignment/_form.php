<?php $form = $this->beginWidget('TbActiveForm'); ?>

<?php echo $form->dropDownListRow($model, 'itemname', $itemnameSelectOptions); ?>

<div class="form-actions">
    <?php //echo CHtml::submitButton(Rights::t('core', 'Assign')); ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => 'Assign',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>

