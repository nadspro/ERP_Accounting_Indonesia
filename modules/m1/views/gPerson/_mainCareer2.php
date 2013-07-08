<?php

EQuickDlgs::iframeButton(
        array(
            'controllerRoute' => 'm1/gPerson/createAssignmentAjax',
            'actionParams' => array('id' => $model->id),
            'dialogTitle' => 'Create New Assignment',
            'dialogWidth' => 800,
            'dialogHeight' => 600,
            'openButtonText' => 'New Assignment',
            // 'closeButtonText' => 'Close',
            'closeOnAction' => true, //important to invoke the close action in the actionCreate
            'refreshGridId' => 'g-karir2-grid', //the grid with this id will be refreshed after closing
            'openButtonHtmlOptions' => array('class' => 'pull-right btn btn-primary'),
        )
);
?> 


<?php echo $this->renderPartial('_tabCareer2', array("model" => $model)); ?>
