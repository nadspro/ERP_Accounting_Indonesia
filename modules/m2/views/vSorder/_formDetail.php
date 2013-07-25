<?php

$this->widget('TbGridView', array(
    'id' => 'b-porder-detail-grid',
    'dataProvider' => $dataProvider,
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        array(
            'header' => 'Item',
            'value' => 'xProduct::model()->findByPk($data["item_id"])->item_name',
        ),
        'description',
        'qty',
        'amount',
        array(
            'class' => 'TbButtonColumn',
            'template' => '{myDelete}',
            'buttons' => array
                (
                'myDelete' => array
                    (
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("/m2/vSorderInventory/DeleteTempById",array("id"=>(int)$data["id"]))',
                    'options' => array(
                        'ajax' => array(
                            'type' => 'GET',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'js:function(data){$.fn.yiiGridView.update("b-porder-detail-grid", {data: $(this).serialize()});
}',
                        ),
                    ),
                ),
            ),
        ),
    ),
));
?>
