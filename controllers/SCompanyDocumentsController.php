<?php

class SCompanyDocumentsController extends Controller {

    public $layout = '//layouts/mainAuth';

    public function filters() {
        return array(
            //'accessControl',
            'rights',
        );
    }

    public function actions() {
        return array(
            //Admin Share for All Authenticated User
            'connectorCompanyDocuments' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot.sharedocs.companydocuments'),
                    'URL' => Yii::app()->baseUrl . '/sharedocs/companydocuments/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                    //'uploadDeny'    => array(Yii::app()->user->name),
                    'disabled' => array('upload', 'mkdir', 'mkfile', 'mv', 'rm', 'cp'), // list of not allowed commands
                    'defaults' => array('read' => true, 'write' => false),
                )
            ),
            'connectorPublicDocuments' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot.sharedocs.publicdocuments'),
                    'URL' => Yii::app()->baseUrl . '/sharedocs/publicdocuments/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                )
            ),
            'connectorPersonalDocuments' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot.sharedocs.personaldocuments') . '/' . Yii::app()->user->name . '/',
                    'URL' => Yii::app()->baseUrl . '/sharedocs/personaldocuments/' . Yii::app()->user->name . '/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                )
            ),
        );
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