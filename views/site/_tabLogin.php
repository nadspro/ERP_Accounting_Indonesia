<?php
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => false,
    'headerIcon' => 'icon-globe',
));
?>

<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'login-form',
    //'type'=>'horizontal',
    //'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span2')); ?>

<?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span2')); ?>

<?php if ($model->getIsNeedCaptcha()): ?>
    <?php if (extension_loaded('gd')): ?>
        <?php echo $form->labelEx($model, 'verifyCode'); ?>
        <div>
            <?php $this->widget('CCaptcha'); ?>
            <?php echo $form->textField($model, 'verifyCode'); ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php //echo $form->checkBoxRow($model,'rememberMe');  ?>

<p>
    <?php echo "Are you employee? " . CHtml::link('register here', Yii::app()->createUrl('site/register')); ?>
</p>

<div class="form-actions">
    <?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class' => 'btn btn-primary', 'type' => 'submit')); ?>
</div>

<?php $this->endWidget(); ?>

<?php $this->endWidget(); ?>

