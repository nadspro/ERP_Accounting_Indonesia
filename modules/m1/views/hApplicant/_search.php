<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'method' => 'get',
    'id' => 'searchForm',
    'type' => 'horizontal',
    'action' => Yii::app()->createUrl('/m1/hApplicant/filter'),
        ));
?>

<?php echo $form->textFieldRow($model, 'keyword', array('class' => 'span4', 'hint' => 'search contain name or job title')); ?>

<?php //echo $form->dropDownListRow($model,'sex_id',sParameter::itemsWithAll('cKelamin')); ?>

<?php /*
  <div class="control-group">
  <label class="control-label" for="fSearchApplicant_age_start">Age</label>
  <div class="controls">
  <?php //echo $form->textField($model,'age_start',array('class'=>'span1')); ?>
  <?php //echo $form->textField($model,'age_end',array('class'=>'span1')); ?>
  </div>
  </div>

  <div class="control-group">
  <label class="control-label" for="fSearchApplicant_experience_start">Experience</label>
  <div class="controls">
  <?php echo $form->textField($model,'experience_start',array('class'=>'span1')); ?>
  <?php echo $form->textField($model,'experience_end',array('class'=>'span1')); ?>
  </div>
  </div>

 */ ?>

<?php //echo $form->dropDownListRow($model,'education_id',sParameter::itemsWithAll('EDU'));  ?>

<div class="control-group">
    <div class="controls">
        <?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class' => 'btn', 'type' => 'submit')); ?>
    </div>
</div>
<?php
$this->endWidget();