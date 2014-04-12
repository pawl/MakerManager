<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/editable');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Maker Manager',
	'aliases' => array(
			'RestfullYii' =>realpath(__DIR__ . '/../extensions/starship/RestfullYii'),
    ),
	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'editable.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'secret',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('1.1.1.1'),
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
		'editable' => array(
            'class'     => 'editable.EditableConfig',
            'form'      => 'bootstrap', 
            'mode'      => 'popup',      
            'defaults'  => array(        
               'emptytext' => 'Click to edit',
               //'ajaxOptions' => array('dataType' => 'json') //usefull for json exchange with server
            )
        ),
		'CURL' =>array(
		   'class' => 'ext.curl.Curl',
		),
		'urlManager'=>array(
			//'urlFormat'=>'path',
			'rules'=>array(
				//'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				//'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				//'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				dirname(__FILE__).'/../extensions/starship/restfullyii/config/routes.php',
			),
		),
		'db'=> require(dirname(__FILE__) . '/db.php'),
        'dbwhmcs' => require(dirname(__FILE__) . '/whmcs_db.php'),
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
	'params'=>require(dirname(__FILE__).'/params.php'),
);
