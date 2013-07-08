<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */

$this->breadcrumbs = array(
//	'Register'=>array('index'),
//	'Create',
);

$this->menu = array(
);
?>


<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        ESS (Employee Self Service)  Registration</h1>
</div>

<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 's-user-registration-form',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span4', 'hint' => 'type your desire username')); ?>
<?php echo $form->textFieldRow($model, 'activation_code', array('class' => 'span4', 'hint' => 'ask your HR Manager for your activation code')); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3')); ?>
<?php echo $form->passwordFieldRow($model, 'password_repeat', array('class' => 'span3')); ?>

<?php if (extension_loaded('gd')): ?>

        <?php echo $form->labelEx($model, 'verifyCode'); ?>
    <div>
    <?php $this->widget('CCaptcha', array('clickableImage' => true)); ?>
    <?php echo CHtml::tag('div', array(), $form->textField($model, 'verifyCode')); ?>
    </div>

<?php endif; ?>


<div class="form-actions">
<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class' => 'btn btn-primary', 'type' => 'submit')); ?>
</div>

<?php $this->endWidget(); ?>
