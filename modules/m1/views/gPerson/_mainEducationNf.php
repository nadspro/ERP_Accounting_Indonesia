<?php

EQuickDlgs::iframeButton(
        array(
            'controllerRoute' => 'm1/gPerson/createEducationNfAjax',
            'actionParams' => array('id' => $model->id),
            'dialogTitle' => 'Create New Education Non Formal',
            'dialogWidth' => 800,
            'dialogHeight' => 600,
            'openButtonText' => 'New Education Non Formal',
            // 'closeButtonText' => 'Close',
            'closeOnAction' => true, //important to invoke the close action in the actionCreate
            'refreshGridId' => 'gperson-education-nf-grid', //the grid with this id will be refreshed after closing
            'openButtonHtmlOptions' => array('class' => 'pull-right btn btn-primary'),
        )
);
?> 

<?php echo $this->renderPartial('_tabEducationNf', array("model" => $model, "modelEducationNf" => $modelEducationNf)); ?>

