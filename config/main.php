<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'APHRIS',
    // preloading 'log' component
    //'preload'=>array('log','bootstrap','translate'),
    'preload' => array('log', 'bootstrap'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.reports.*',
        'ext.fpdf.*',
        'ext.wunit.*',
        'ext.quickdlgs.*',
        //'ext.fpdf.fpdf_addons.*',
        'ext.bootstrap.widgets.*',
        //'ext.jasphp.*',
        //'application.modules.rights.*',
        'application.modules.rights.components.*',
        //'application.modules.translate.TranslateModule',
        'application.modules.mailbox.*',
        'application.modules.mailbox.models.*',
        'application.modules.m1.models.*',
    ),
    'modules' => array(
        'mailbox' => array(
            'userClass' => 'sUser',
            'userIdColumn' => 'id',
            'usernameColumn' => 'username',
            'superuserColumn' => 'username',
        //'juiThemes'=>'base',
        //....more options here....
        //....more options here....
        ),
        //'forum', //on_development
        'rights',
        //'translate',  //not_currently_used
        'm1', //Human Resources
        'm2', //Acounting
        'm3', //Budget Controller
        'm4', //Asset Management
        'm5', //Process Production

        /**/
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1234qwe',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        //'ipFilters' => array('127.0.0.1', '::1'),
        ),
    /**/
    ),
    'defaultController' => 'site',
    'timeZone' => 'Asia/Jakarta',
    'sourceLanguage' => 'id_id',
    'language' => 'en',
    'theme' => 'bootstrap',
    'controllerMap' => array(
        'YiiFeedWidget' => 'ext.yii-feed-widget.YiiFeedWidgetController'
    ),
    // application components
    'components' => array(
        //'widgetFactory'=>array(  
        //'widgets'=>array(
        //'CJuiAutoComplete'=>array(
        //	'options'=>array(
        //		'minLength'=>'3',
        //	),
        //),
        //'CJuiDatePicker'=>array(
        //	'htmlOptions'=>array(
        //		'style'=>'min-height: 30px;',
        //	),
        //),
        //),
        //),
        'iwi' => array(
            'class' => 'application.extensions.iwi.IwiComponent',
            'driver' => 'GD',
        // ImageMagick setup path
        //'params'=>array('directory'=>'C:/ImageMagick'),
        ),
        //'clientScript' => array(
        //		'class'=>'ext.EScriptBoost.EClientScriptBoost',
        // 		'cacheDuration'=>30,
        //),
        'browser' => array(
            'class' => 'ext.EWebBrowser',
        ),
        //'jasPHP' => array(
        //	'class' => 'JasPHP',
        //'orientation'=>'portrait',
        //),
        'cache' => array(
            //'class'=>'system.caching.CFileCache',
            //'class' => 'CZendDataCache',
	        'class'=>'CDummyCache',
        ),
        'session' => array(
            'class' => 'CCacheHttpSession',
        ),
        'indoFormat' => array(
            'class' => 'ext.IndoNumberFormatter',
        	//'class'=>'system.utils.CLocalizedFormatter',
	        //'locale'=>'id_id',
        ),
        'settings' => array(
            'class' => 'CmsSettings',
            'cacheComponentId' => 'cache',
            'cacheId' => 'global_website_settings',
            'cacheTime' => 84000,
            'tableName' => 's_settings',
            'dbComponentId' => 'db',
            'createTable' => true,
            'dbEngine' => 'InnoDB',
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
            'fontAwesomeCss' => true,
        ),
        'user' => array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=erp_apl',
            //'connectionString'=>'pgsql:host=localhost;port=5432;dbname=erp_apl',
            'emulatePrepare' => true,
            //'username' => 'postgres',
            'username' => 'root',
            'password' => '1234qwe',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'schemaCachingDuration' => 180,
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'itemTable' => 's_authitem',
            'assignmentTable' => 's_authassignment',
            'itemChildTable' => 's_authitemchild',
        ),
        //'messages'=>array(
        //	'class'=>'CDbMessageSource',
        //	//'cachingDuration'=>120,
        //	'sourceMessageTable' => 's_trans_sourcemessage',
        //	'translatedMessageTable' => 's_trans_message',
        //	'onMissingTranslation' => array('Ei18n', 'missingTranslation'),
        //	//'language'=>'id',
        //),
        //'translate' => array(
        //	'class' => 'translate.components.Ei18n',
        //	'createTranslationTables' => true,
        //	'connectionID' => 'db',
        //	'languages' => array(
        //		'en' => 'English',
        //		'id' => 'Indonesia',
        //	)
        //),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        /**/
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            //'caseSensitive'=>false,
            'rules' => array(
            //'dashboard' => 'menu',
            //'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            //'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
            ),
        ),
        /**/
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                  array(
                  'class'=>'CWebLogRoute',
                  ),
                 */

                /**/
                array(
                    'class' => 'ext.db_profiler.DbProfileLogRoute',
                    'countLimit' => 1, // How many times the same query should be executed to be considered inefficient
                    'slowQueryMin' => 0.01, // Minimum time for the query to be slow
                ),
	            /*
	            array(
                    'class'=>'ext.LogDb',
                    'autoCreateLogTable'=>true,
                    'connectionID'=>'db',
                    'enabled'=>true,
                    'levels'=>'error',//You can replace trace,info,warning,error
                ),
                */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);
