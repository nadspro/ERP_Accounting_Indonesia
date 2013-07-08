<?php

class SCompanyDocumentsAdminController extends Controller {

    public $layout = '//layouts/mainAuth';

    public function filters() {
        return array(
            'rights',
        );
    }

    public function actions() {
        return array(
            //Photo News Admin Management
            'connectorPhotoDocumentsAdmin' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot.shareimages'),
                    'URL' => Yii::app()->baseUrl . '/shareimages/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                )
            ),
            //Admin Share for All Authenticated User
            'connectorCompanyDocumentsAdmin' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot.sharedocs.companydocuments'),
                    'URL' => Yii::app()->baseUrl . '/sharedocs/companydocuments/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                )
            ),
        );
    }

    public function actionIndex() {
        $this->render('companyDocumentsAdmin');
    }

}

/*
  //server file input
  $this->widget('ext.elFinder.ServerFileInput', array(
  'model' => $model,
  'attribute' => 'serverFile',
  'connectorRoute' => 'admin/elfinder/connector',
  )
  );

  // ElFinder widget
  $this->widget('ext.elFinder.ElFinderWidget', array(
  'connectorRoute' => 'admin/elfinder/connector',
  )
  );

 */
?>