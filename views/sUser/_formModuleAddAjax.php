<div id="form">

    <?php
    $this->widget('ext.EChosen.EChosen', array(
        'target' => 'select',
    ));
    ?>

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'matrix-user-module-formAdd',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'onsubmit' => "return false;", /* Disable normal form submit */
            'onkeypress' => " if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
        ),
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model, 's_module_id', sModule::itemsAll(), array('class' => 'span8', 'multiple' => 'multiple')); ?>

    <?php echo $form->dropDownListRow($model, 's_matrix_id', sMatrix::items('sMatrix'), array('class' => 'span3')); ?>
    <?php //echo $form->dropDownListRow($model,'s_matrix_id', array("5"=>"admin"),array('class'=>'span3')); ?>

    <?php
    echo CHtml::ajaxSubmitButton(
            'Submit', $this->createUrl('sUser/NewUserModuleAjax'), array(
        'type' => 'POST',
        'url' => Yii::app()->createUrl('sUser/NewUserModuleAjax'),
        'data' => 'data',
        'dataType' => 'html',
        'success' => 'js:function(data) {  
				$("#form").html("<div id=\'message\'></div>");  
				$("#message").html("<h2>Contact Form Submitted!</h2>")  
				.hide()  
				.fadeIn(1500, function() {  
					$("#message").append(data);  
				});  
			}',
        'error' => 'js:function(data) { // if error occured
				 //alert("Error occured.please try again");
				 alert(data);
			}',
            )
    );
    ?>


    <?php $this->endWidget(); ?>

</div>