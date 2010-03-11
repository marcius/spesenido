<?php

return array(
    'name'=>'My Web Application (DEV)',
    'import'=>array(
        'application.extensions.yiidebugtb.*',
    ),
	'components'=>array(
        'urlManager'=>array(
            'urlFormat'=>'get',
            ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=nido',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableParamLogging' => true,
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
/*                array(
                  'class'=>'XWebDebugRouter',
                  'config'=>'alignLeft, opaque, runInDebug, fixedPos',
                  'levels'=>'error, warning, trace, profile, info'
                ), 
*/                
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
    ),
);