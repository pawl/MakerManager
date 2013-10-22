<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Maker Manager',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'secret',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
				'bootstrap.gii'
			),
		),
	),
	'theme'=>'bootstrap',
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'bootstrap' => array(
			'class' => 'ext.bootstrap.components.Bootstrap',
			'responsiveCss' => true,
		),
		'CURL' =>array(
		   'class' => 'ext.curl.Curl',
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=dms_crm',
			'username'=>'dmsadmin',
			'password'=>'1complexPassword',
		),
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=dms_crm',
			'emulatePrepare' => true,
			'username' => 'user',
			'password' => 'secret',
			'charset' => 'utf8',
			'class'=>'CDbConnection',
		),
        'dbwhmcs' => array(
            'connectionString' => 'mysql:host=localhost;dbname=dms-whmcs',
			'emulatePrepare' => true,
            'username'         => 'user',
            'password'         => 'secret',
			'charset' => 'utf8',
			'class'=>'CDbConnection',
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
				// Send errors via email to the system admin
				/* array(
						'class'=>'CEmailLogRoute',
						'levels'=>'error, warning',
						'emails'=>'admin@example.com',
				), */
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
		'adminEmail'=>'paul.brown@dallasmakerspace.org',
		'ldap' => array(
			'host' => 'localhost',
			'ou' => 'people', // such as "people" or "users"
			'dc' => array('dallasmakerspace','org'),
		),
	),
);
