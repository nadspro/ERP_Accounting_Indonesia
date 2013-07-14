<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'sFeedback-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>
<?php
if (Yii::app()->user->name == 'admin')
    echo $form->dropDownListRow($model, 'type_id', sParameter::items("cNotifType"));
?>



<?php //echo $form->dropDownListRow($model, 'receiver_id', sUser::model()->allUsers()); ?>
<?php echo $form->dropDownListRow($model, 'receiver_id', array('1' => 'Admin')); ?>

<?php echo $form->dropDownListRow($model, 'category_id', sParameter::items("cCategory")); ?>

<?php echo $form->textFieldRow($model, 'sender_ref', array()); ?>

<?php echo $form->textAreaRow($model, 'long_desc', array('class' => 'span6', 'rows' => 6)); ?>
<?php
//$this->widget('application.extensions.tinymce.ETinyMce',
//	array('name'=>'html','model'=>$model,'attribute'=>'long_desc'));
?>

<?php echo $form->textAreaRow($model, 'link', array('class' => 'span6', 'rows' => 2)); ?>

<?php echo $form->dropDownListRow($model, 'priority_level_id', sParameter::items("cPriority")); ?>

<?php
if (Yii::app()->user->name == 'admin')
    echo $form->dropDownListRow($model, 'status_id', sParameter::items("cRead"));
?>

<div class="form-actions">
    <?php echo CHtml::htmlButton('<i class="icon-ok"></i> Send', array('class' => 'btn', 'type' => 'submit')); ?>
</div>

<?php $this->endWidget(); ?>
