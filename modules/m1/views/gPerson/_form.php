<style>
    .userautocompletelink {height:52px;}
    .userautocompletelink img {float:left;margin-right:5px;width:40px;}

</style>

<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
//        ->registerScriptFile(Yii::app()->baseUrl . "/css/bootstrapFormHelpers/js/bootstrap-formhelpers-phone.js")
//        ->registerScriptFile(Yii::app()->baseUrl . "/css/bootstrapFormHelpers/js/bootstrap-formhelpers-phone.format.js");


Yii::app()->clientScript->registerScript('datepicker4', "
		$(function() {
		$( \"#" . CHtml::activeId($model, 'birth_date') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		'changeMonth' : true,
        'changeYear' : true,
		'yearRange' : '" . date("Y", strtotime("-65 year")) . ":" . date("Y", strtotime("-15 year")) . "',
		});
		
		$( \"#" . CHtml::activeId($model, 'identity_valid') . "\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		'changeMonth' : true,
        'changeYear' : true,
		'yearRange' : '" . date("Y") . ":" . date("Y", strtotime("+20 year")) . "',
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
    <div class="span9">
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            'legend' => 'Basic Info',
            'fieldsetHtmlOptions' => array('style' => 'padding:12px'),
        ));
        ?>   

        <div class="row">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'employee_code', array('class' => 'span2')); ?>

                <?php echo $form->textFieldRow($model, 'employee_name', array('class' => 'span3')); ?>

                <?php echo $form->textFieldRow($model, 'birth_place', array('class' => 'span2')); ?>

                <?php echo $form->textFieldRow($model, 'birth_date', array('class' => 'span2')); ?>

            </div>
            <div class="span4">
                <?php echo $form->dropDownListRow($model, 'sex_id', sParameter::items("cKelamin")); ?>

                <?php echo $form->dropDownListRow($model, 'religion_id', sParameter::items("cAgama")); ?>

                <?php echo $form->textFieldRow($model, 'blood_id', array('class' => 'span1')); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

    </div>
</div>
<div class="row">
    <div class="span9">
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            'legend' => 'Address',
            'fieldsetHtmlOptions' => array('style' => 'padding:12px'),
        ));
        ?>   
        <?php echo $form->textAreaRow($model, 'address1', array('class' => 'span4', 'rows' => 5)); ?>

        <?php //echo $form->textFieldRow($model,'address2',array()); ?>

        <?php //echo $form->textFieldRow($model,'address3',array());  ?>

        <?php echo $form->textFieldRow($model, 'pos_code', array('class' => 'span2')); ?>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->


    </div>
</div>

<div class="row">
    <div class="span9">
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            'legend' => 'Identity',
            'fieldsetHtmlOptions' => array('style' => 'padding:12px'),
        ));
        ?>   
        <?php echo $form->textFieldRow($model, 'identity_number', array()); ?>

        <?php echo $form->textFieldRow($model, 'identity_valid'); ?>

        <?php echo $form->textAreaRow($model, 'identity_address1', array('class' => 'span4', 'rows' => 5)); ?>

        <?php //echo $form->textFieldRow($model,'identity_address2',array());  ?>

        <?php //echo $form->textFieldRow($model,'identity_address3',array());  ?>

        <?php echo $form->textFieldRow($model, 'identity_pos_code', array('class' => 'span2')); ?>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

    </div>
</div>

<div class="row">
    <div class="span9">
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            'legend' => 'Contact',
            'fieldsetHtmlOptions' => array('style' => 'padding:12px'),
        ));
        ?>   

        <div class="row">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'email', array()); ?>

                <?php //echo $form->textFieldRow($model,'email2',array());  ?>

                <?php echo $form->textFieldRow($model, 'home_phone', array()); ?>

            </div>
            <div class="span4">
                <?php //echo $form->textFieldRow($model, 'handphone', array("class" => "input-medium bfh-phone", "data-format" => "+62 ddd dddddddddd")); ?>
                <?php echo $form->textFieldRow($model, 'handphone', array("class" => "input-medium")); ?>

                <?php echo $form->textFieldRow($model, 'handphone2', array()); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

    </div>
</div>

<div class="row">
    <div class="span9">
        <?php
        $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
            'legend' => 'Bank',
            'fieldsetHtmlOptions' => array('style' => 'padding:12px'),
        ));
        ?>   
        <?php echo $form->textFieldRow($model, 'account_number', array('class' => 'span2')); ?>

        <?php echo $form->textFieldRow($model, 'account_name', array('class' => 'span3')); ?>

        <?php echo $form->textFieldRow($model, 'bank_name', array()); ?>

        <?php $this->endWidget(); ?><!-- collabsible fieldset -->

    </div>
</div>

<div class="row">
    <div class="span9">
        <?php
        if ($model->scenario == 'create') {
            $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
                'legend' => 'Career',
                'fieldsetHtmlOptions' => array('style' => 'padding:12px'),
            ));

            echo $this->renderPartial('_formCareerInit', array('form' => $form, 'model' => $modelCareer));

            $this->endWidget();
        }
        ?><!-- collabsible fieldset -->
    </div>
</div>

<div class="row">
    <div class="span9">
        <?php
        if ($model->scenario == 'create') {
            $this->beginWidget('ext.coolfieldset.JCollapsibleFieldset', array(
                'legend' => 'Status',
                'fieldsetHtmlOptions' => array('style' => 'padding:12px'),
            ));
            echo $this->renderPartial('_formStatusInit', array('form' => $form, 'model' => $modelStatus));

            $this->endWidget();
        }
        ?><!-- collabsible fieldset -->
    </div>
</div>

<div class="row">
    <div class="span9">

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


