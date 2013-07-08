<?php

EQuickDlgs::iframeButton(
        array(
            'controllerRoute' => 'm1/gPerson/createExperienceAjax',
            'actionParams' => array('id' => $model->id),
            'dialogTitle' => 'Create New Experience',
            'dialogWidth' => 800,
            'dialogHeight' => 600,
            'openButtonText' => 'New Experience',
            // 'closeButtonText' => 'Close',
            'closeOnAction' => true, //important to invoke the close action in the actionCreate
            'refreshGridId' => 'g-person-experience-grid', //the grid with this id will be refreshed after closing
            'openButtonHtmlOptions' => array('class' => 'pull-right btn btn-primary'),
        )
);
?> 

<?php echo $this->renderPartial('_tabExperience', array("model" => $model, "modelExperience" => $modelExperience)); ?>

