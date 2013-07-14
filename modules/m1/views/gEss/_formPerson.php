<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'identity_valid') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
			
});

		");
?>

<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'g-person-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="span10">
        <?php /*
          <?php $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
          'legend'=>'Basic Info'
          )); ?>

          <?php echo $form->textFieldRow($model,'employee_code',array()); ?>

          <?php echo $form->textFieldRow($model,'employee_name',array()); ?>

          <?php echo $form->textFieldRow($model,'birth_place',array()); ?>

          <?php echo $form->textFieldRow($model,'birth_date'); ?>

          <?php echo $form->dropDownListRow($model,'sex_id',sParameter::items("cKelamin")); ?>

          <?php echo $form->dropDownListRow($model,'religion_id',sParameter::items("cAgama")); ?>

          <?php $this->endWidget(); ?><!-- collabsible fieldset -->
         */ ?>	
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            'legend' => 'Address'
        ));
        ?>   
        <?php echo $form->textAreaRow($model, 'address1', array('rows' => 4, 'class' => 'span5')); ?>

        <?php //echo $form->textFieldRow($model,'address2',array()); ?>

        <?php //echo $form->textFieldRow($model,'address3',array()); ?>

        <?php echo $form->textFieldRow($model, 'pos_code', array('class' => 'span2')); ?>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            'legend' => 'Identity'
        ));
        ?>   
        <?php echo $form->textFieldRow($model, 'identity_number', array('class' => 'span3')); ?>

        <?php echo $form->textFieldRow($model, 'identity_valid'); ?>

        <?php echo $form->textAreaRow($model, 'identity_address1', array('rows' => 4, 'class' => 'span5')); ?>

        <?php //echo $form->textFieldRow($model,'identity_address2',array()); ?>

        <?php //echo $form->textFieldRow($model,'identity_address3',array()); ?>

        <?php echo $form->textFieldRow($model, 'identity_pos_code', array('class' => 'span2')); ?>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            'legend' => 'Contact'
        ));
        ?>   
        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span3')); ?>

        <?php echo $form->textFieldRow($model, 'email2', array('class' => 'span3')); ?>

        <?php echo $form->textFieldRow($model, 'blood_id', array('class' => 'span1')); ?>

        <?php echo $form->textFieldRow($model, 'home_phone', array('class' => 'span2')); ?>

        <?php echo $form->textFieldRow($model, 'handphone', array('class' => 'span3')); ?>

        <?php echo $form->textFieldRow($model, 'handphone2', array('class' => 'span3')); ?>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->
        <?php /*
          <?php $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
          'legend'=>'Bank'
          )); ?>
          <?php echo $form->textFieldRow($model,'account_number',array()); ?>

          <?php echo $form->textFieldRow($model,'account_name',array()); ?>

          <?php echo $form->textFieldRow($model,'bank_name',array()); ?>

          <?php $this->endWidget(); ?><!-- collabsible fieldset -->
         */ ?>
    </div>
</div>
<div class="row">
    <div class="span10">

        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ));
            ?>

        </div>
    </div>
</div>

<?php
$this->endWidget();
