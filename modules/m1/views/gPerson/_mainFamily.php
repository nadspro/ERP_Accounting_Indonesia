<?php

EQuickDlgs::iframeButton(
        array(
            'controllerRoute' => 'm1/gPerson/createFamilyAjax',
            'actionParams' => array('id' => $model->id),
            'dialogTitle' => 'Create New Family',
            'dialogWidth' => 800,
            'dialogHeight' => 600,
            'openButtonText' => 'New Family',
            // 'closeButtonText' => 'Close',
            'closeOnAction' => true, //important to invoke the close action in the actionCreate
            'refreshGridId' => 'g-person-family-grid', //the grid with this id will be refreshed after closing
            'openButtonHtmlOptions' => array('class' => 'pull-right btn btn-primary'),
        )
);
?> 


<?php echo $this->renderPartial('_tabFamily', array("model" => $model, "modelFamily" => $modelFamily)); ?>

