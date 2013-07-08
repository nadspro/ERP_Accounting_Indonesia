<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'id' => 'grid-sso',
    'data' => $model,
    'attributes' => array(
        'activation_code',
        array(
            'name' => 'activation_expire',
            'value' => date("d-m-Y h:i", $model->activation_expire),
        ),
    ),
));
?>
<p>
    <?php
    echo CHtml::link('Generate Code', Yii::app()->createUrl("/m1/gPerson/updateSso", array("id" => $model->id))
    );
    ?>	
</p>



