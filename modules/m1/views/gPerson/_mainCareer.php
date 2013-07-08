<?php

EQuickDlgs::iframeButton(
        array(
            'controllerRoute' => 'm1/gPerson/createCareerAjax',
            'actionParams' => array('id' => $model->id),
            'dialogTitle' => 'Create New Career',
            'dialogWidth' => 800,
            'dialogHeight' => 600,
            'openButtonText' => 'New Career',
            // 'closeButtonText' => 'Close',
            'closeOnAction' => true, //important to invoke the close action in the actionCreate
            'refreshGridId' => 'g-karir-grid', //the grid with this id will be refreshed after closing
            'openButtonHtmlOptions' => array('class' => 'pull-right btn btn-primary'),
        )
);
?> 

<?php echo $this->renderPartial('_tabCareer', array("model" => $model, "modelCareer" => $modelCareer)); ?>

