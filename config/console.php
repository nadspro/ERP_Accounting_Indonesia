<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'charset' => 'utf-8',
    'timeZone' => 'Asia/Jakarta',
    'components' => array(
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
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'cron.log',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'cron_trace.log',
                    'levels' => 'trace',
                ),
            ),
        ),
    ),
    'import' => array(
        'application.components.*',
        'application.models.*',
    ),
    'name' => 'Cron',
    'params' => require(dirname(__FILE__) . '/params.php'),
    'preload' => array('log'),
);
?>