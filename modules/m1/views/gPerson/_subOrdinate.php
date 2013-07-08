<?php //if (isset($model->company->department_id)):  ?>

<h4>
    List of Subordinate 
</h4>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'g-person1-grid',
    'dataProvider' => gPerson::model()->subOrdinate($model->id),
    'enableSorting' => false,
    'template' => '{items}{pager}',
    'htmlOptions' => array('style' => 'padding-top:0'),
    'columns' => array(
        array(
            'type' => 'raw',
            'value' => 'CHtml::link($data->PhotoPath,Yii::app()->createUrl("' . $this->route . '/../view",array("id"=>$data->id,)))',
            'htmlOptions' => array("width" => "60px"),
        ),
        array(
            'header' => 'Name',
            'type' => 'raw',
            'value' => function($data) {
                return CHtml::tag('div', array('style' => 'font-weight: bold'), $data->GPersonLink)
                        //. CHtml::tag('div', array('style'=>'color: #999; font-size: 11px'), $data->employee_code)
                        . CHtml::tag('div', array(), $data->mJobTitle())
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->mLevel());
            },
            'visible' => $this->id == "gPerson",
        ),
        array(
            'header' => 'Name',
            'type' => 'raw',
            'value' => function($data) {
                return CHtml::tag('div', array('style' => 'font-weight: bold'), $data->GTalentLink)
                        //. CHtml::tag('div', array('style'=>'color: #999; font-size: 11px'), $data->employee_code)
                        . CHtml::tag('div', array(), $data->mJobTitle())
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->mLevel());
            },
            'visible' => $this->id == "gTalent",
        ),
    ),
));
?>

<?php //endif;

