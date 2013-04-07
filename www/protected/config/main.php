<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    'language' => 'ru',
    // preloading 'log' component
    'preload' => array('log'),
    //'theme' => 'freearch',
    'theme' => 'classic',
  
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.extensions.*',
        'application.components.*',
        'zii.widgets.*',
        
        
    ),
  
    
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'admin',
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
          'clientScript' => array(
            'scriptMap' => array(
                'jquery.js' => '/js/jquery-1.9.1.js',
                'jquery.min.js' => '/js/jquery-1.9.1.min.js',
             
                'jquery-ui.min.js' => '/js/jquery-ui-1.10.2.custom.min',
                'jquery-ui.min.css' => '/js/jquery-ui-1.10.2.custom/css/redmond/jquery-ui-1.10.2.custom.min.css',
            )
           
        ),
        'init' => array(
            'class' => 'application.components.Init'
        ),
        'user' => array(
            // enable cookie-based authentication
            'class'=>'application.components.Users',
            'allowAutoLogin' => true,
            'groups'=>array('admin', 'manager', 'content')
        ),
       
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                
                'admin/login'=>'admin/default/login',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                'sitemap' => 'site/sitemap',
                'page/' => 'page/index',
               // 'page/<url:[a-zA-Z0-9-]+>/page/<page>' => 'page/view',
                'page/<url:[a-zA-Z0-9-]+>' => 'pages/view',
                'news/'=>'news/index',
                'news/<url:[a-zA-Z0-9-]+>'=>'news/view',
                
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                
                
            ),
        ),
        /*
          'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
          // uncomment the following to use a MySQL database
         */
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=ysv',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
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
              ),*/
            
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'softartclub@gmail.com',
        'webroot'=>$_SERVER['DOCUMENT_ROOT'],
        'version'=>array('core'=>'alpha 1.0.1')
            
    ),
);