<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
    'sourceLanguage'=>'it_it',
    'language'=>'it',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=emmecubo_nido',
            //'connectionString' => 'mysql:host=66.147.244.162;dbname=emmecubo_nido',
            'username' => 'emmecubo_nido',
            //'connectionString' => 'mysql:host=74.54.18.146;dbname=sguarauz_nido',
            //'username' => 'sguarauz_nido',
            'password' => 'nidonido',
            'charset' => 'utf8',
            'enableParamLogging' => true,
            'emulatePrepare' => true,
		),
        'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
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

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);