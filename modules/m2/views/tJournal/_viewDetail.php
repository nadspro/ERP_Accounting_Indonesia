<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'u-journal-detail-grid',
    'dataProvider' => tJournalDetail::model()->search($data->id),
    'template' => '{items}{pager}',
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'htmlOptions' => array('style' => 'padding-top:0'),
    'columns' => array(
        array(
            'name' => 'account_no_id',
            'type' => 'raw',
            'value' => 'CHtml::link($data->account->account_concat,Yii::app()->createUrl("/m2/tAccount/view",array("id"=>$data->account->id)))',
        ),
        array(
            'name' => 'currency',
            'value' => '$data->account->cCurrency',
        ),
        //'sub_account_id',
        array(
            'class' => 'ext.gridcolumns.TotalColumn',
            'name' => 'debit',
            'output' => 'Yii::app()->indoFormat->number($value)',
            'type' => 'raw',
            'footer' => true,
            'htmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px;'
            ),
            'footerHtmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px; font-weight:bold'
            ),
        ),
        array(
            'class' => 'ext.gridcolumns.TotalColumn',
            'name' => 'credit',
            'output' => 'Yii::app()->indoFormat->number($value)',
            'type' => 'raw',
            'footer' => true,
            'htmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px;'
            ),
            'footerHtmlOptions' => array(
                'style' => 'text-align: right; padding-right: 5px; font-weight:bold'
            ),
        ),
        /* array(
          'class'=>'ext.gridcolumns.CalcColumn',
          'value'=>'$data->debit+$data->credit',
          'output'=>'Yii::app()->indoFormat->number($value)',
          'footerOutput'=>'Yii::app()->indoFormat->number($value)',
          'type'=>'raw',
          'footer'=>true,
          'htmlOptions'=>array(
          'style'=>'text-align: right; padding-right: 5px;'
          ),
          'footerHtmlOptions'=>array(
          'style'=>'text-align: right; padding-right: 5px;'
          ),
          ), */
        'user_remark',
    //'system_remark',
    ),
));
?>


<?php ?>
