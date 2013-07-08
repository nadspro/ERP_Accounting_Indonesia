<?php /*
  EQuickDlgs::ajaxButton(
  array(
  'controllerRoute' => 'm1/gPerson/createOtherAjax',
  'actionParams' => array('id'=>$model->id),
  'dialogTitle' => 'Create New Other Info',
  'dialogWidth' => 800,
  'dialogHeight' => 600,
  'openButtonText' => 'New Other Info',
  // 'closeButtonText' => 'Close',
  'closeOnAction' => true, //important to invoke the close action in the actionCreate
  'refreshGridId' => 'g-person-other-grid', //the grid with this id will be refreshed after closing
  'openButtonHtmlOptions' => array('class'=>'pull-right btn btn-primary'),
  )
  ); */
?> 


<?php

$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'g-person-other-grid',
    'dataProvider' => gPersonOther::model()->search($model->id),
    //'filter'=>$model,
    'template' => '{items}',
    'columns' => array(
        'category_name',
        'document_number',
        'issued_date',
        'valid_to',
        'custom_info1',
        //'custom_info2',
        //'custom_info3',
        'remark',
        array(
            'class' => 'EJuiDlgsColumn',
            'template' => '{update}{delete}',
            //'updateButtonImageUrl'=>Yii::Yii::app()->baseUrl .'images/viewdetaildialog.png',
            'deleteButtonUrl' => 'Yii::app()->createUrl("m1/gPerson/deleteOther",array("id"=>$data->id))',
            'updateDialog' => array(
                'controllerRoute' => 'm1/gPerson/updateOther',
                'actionParams' => array('id' => '$data->id'),
                'dialogTitle' => 'Update Other',
                'dialogWidth' => 512, //override the value from the dialog config
                'dialogHeight' => 530
            ),
            'visible' => ($this->id == "gPerson")
        ),
    ),
));
?>

