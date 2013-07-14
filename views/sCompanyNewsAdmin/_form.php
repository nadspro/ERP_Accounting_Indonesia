<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'sNotification-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span7')); ?>

<?php echo $form->dropDownListRow($model, 'category_id', sParameterNews::items()); ?>

<?php echo $form->dropDownListRow($model, 'priority_id', sParameter::items('cPriority')); ?>

<?php echo $form->textFieldRow($model, 'tags', array('class' => 'span3')); ?>

<?php echo $form->dropDownListRow($model, 'approved_id', sParameter::items('cStatusP')); ?>

<div class="control-group">
    <?php echo $form->labelEx($model, 'publish_date', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'publish_date',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
            //'defaultValue' => (isset($model->publish_date)) ? date('d-m-Y',strtotime($model->publish_date)) : date('d-m-Y h:i'),
            ),
            'htmlOptions' => array(
            //'value'=>(isset($model->publish_date)) ? date('d-m-Y',strtotime($model->publish_date)) : date('d-m-Y h:i'),
            )
                )
        );
        ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'expire_date', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'expire_date',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
                'defaultValue' => (isset($model->expire_date)) ? date('d-m-Y h:i', strtotime($model->expire_date)) : date('d-m-Y h:i'),
            ),
            'htmlOptions' => array(
                'hint' => 'When empty, it mean unlimited',
            ),
                )
        );
        ?>
    </div>
</div>

<?php
echo $form->html5EditorRow($model, 'content', array(
    'class' => 'span4', 'rows' => 5, 'height' => '300', 'options' => array('color' => true)));
?>

<div class="form-actions">
    <?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create' : '<i class="icon-ok"></i> Save', array('class' => 'btn', 'type' => 'submit')); ?>
</div>


<?php $this->endWidget(); ?>
