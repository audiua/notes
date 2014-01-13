<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Notes',
	'defaultController' => 'site',
	'sourceLanguage'=>'en',
	'language'=>'uk',
	// 'theme'=>'spring',
	// 'theme'=>'autumn',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.eoauth.*',
		'ext.eoauth.lib.*',
		'ext.lightopenid.*',
		'ext.eauth.services.*',
		'ext.eauth.*',
		'ext.YiiDisqusWidget.YiiDisqusWidget',

	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
		),
		'cache'=>array('class'=>'system.caching.CFileCache'),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName'=>false,
		),
		'bootstrap' => array(
			'class' => 'application.yiibooster.components.Bootstrap',
		),

		'authManager' => array(
			// Будем использовать свой менеджер авторизации
			'class' => 'PhpAuthManager',
			// Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
			'defaultRoles' => array('guest'),
		),

		'viewRenderer'=>array(
			'class' => 'application.vendor.delfit.yii-haml.HamlViewRenderer',
			// delete options below in production
			'ugly' => false,
			'style' => 'nested',
			'debug' => 0,
			'cache' => false,
		  ),
		'loid' => array(
            'class' => 'ext.lightopenid.loid',
        ),
        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => array( // You can change the providers and their classes.
                'google' => array(
                    'class' => 'GoogleOpenIDService',
                    //'realm' => '*.example.org',
                ),
                // 'yandex' => array(
                //     'class' => 'YandexOpenIDService',
                //     //'realm' => '*.example.org',
                // ),
                // 'vkontakte' => array(
                //     // register your app here: https://vk.com/editapp?act=create&site=1
                //     'class' => 'VKontakteOAuthService',
                //     'client_id' => '',
                //     'client_secret' => '',
                // ),
            ),
        ),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		// MySql
		// 'db'=>array(
		// 	'connectionString' => 'mysql:host=localhost;dbname=notes',
		// 	'emulatePrepare' => true,
		// 	'username' => 'root',
		// 	'password' => '0000',
		// 	'charset' => 'utf8',
		// 	'tablePrefix'=>'tb_',
		// 	// 'enableProfiling'=>true,
		// 	// 'enableParamLogging' => true,
		// 	//'schemaCachingDuration'=>3600,
		// ),
		// ----------------
		// Postgres
		'db'=>array(
			'connectionString' => 'pgsql:host = localhost; port = 5432; dbname = notes',
			'emulatePrepare' => true,
			'username' => 'note',
			'password' => '0000',
			// 'charset' => 'utf8',
			'tablePrefix'=>'tb_',
			// 'enableProfiling'=>true,
			// 'enableParamLogging' => true,
			//'schemaCachingDuration'=>3600,
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
					'levels'=>'info',
					'categories'=>'system.*',
					// array(
					// 	// направляем результаты профайлинга в ProfileLogRoute (отображается
					// 	// внизу страницы)
					// 	'class'=>'CProfileLogRoute',
					// 	'levels'=>'profile',
					// 	'enabled'=>true,
					// ),
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