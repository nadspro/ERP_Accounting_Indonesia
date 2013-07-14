<div class="pull-right">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl('/m1/gSelection/list'),
        'method' => 'get',
        'id' => 'searchForm',
        'htmlOptions' => array('class' => 'form-inline'),
    ));
    ?>

    <?php //echo $form->textField($model,'employee_name',array('class'=>'span3','maxlength'=>100)); ?>
    <?php
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' => $model,
        'attribute' => 'candidate_name',
        'source' => $this->createUrl('/m1/gSelection/candidateAutoComplete'),
        'options' => array(
            'minLength' => '2',
            'focus' => 'js:function( event, ui ) {
					$("#' . CHtml::activeId($model, 'candidate_name') . '").val(ui.item.label);
					return false;
}',
            'select' => 'js:function( event, ui ) {
					$("#searchForm").submit();
					return false;
}',
        ),
        'htmlOptions' => array(
            'class' => 'span3',
            'placeholder' => 'Search Name or Position',
        ),
    ));
    ?>

    <?php //echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class'=>'btn','type'=>'submit'));  ?>

    <?php $this->endWidget(); ?>

</div>

