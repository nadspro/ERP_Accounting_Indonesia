<div class="pull-right">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'method' => 'get',
        'id' => 'searchForm',
        'action' => Yii::app()->createUrl('/m1/iLearningHolding/index2'),
        'htmlOptions' => array('class' => 'form-inline'),
    ));
    ?>

    <?php //echo $form->textField($model,'learning_title',array('class'=>'span3','maxlength'=>100)); ?>
    <?php
    $model->learning_title = null;
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' => $model,
        'attribute' => 'learning_title',
        'source' => $this->createUrl('/m1/iLearningHolding/learningAutoComplete'),
        'options' => array(
            'minLength' => '2',
            'focus' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'learning_title') . '").val(ui.item.label);
					return false;
					}',
            'select' => 'js:function( event, ui ) {
					$("#searchForm").submit();
					return false;
					}',
        ),
        'htmlOptions' => array(
            'class' => 'span3',
            'placeholder' => 'Search Learning Title',
        ),
    ));
    ?>

    <?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class' => 'btn', 'type' => 'submit')); ?>

    <?php $this->endWidget(); ?>

</div>


