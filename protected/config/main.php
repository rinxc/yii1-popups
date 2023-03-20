<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'              => 'Всплывающие окна',
    'timeZone'          => 'Europe/Moscow',
    'language'          =>  'ru',
    'sourceLanguage'    => 'ru',
    'defaultController' => 'popups/default/index',
    
    // Тема по умолчанию хранятся в папке themes
    'theme' => 'demo',
    'aliases' => array(
        'assetsBasePath' => 'webroot.themes.demo.assets'
    ),
    // preloading 'log' component
    'preload'=>array(
     //   'log',
    ),
    // autoloading model and component classes
    'import'=>array(
        'application.components.*',
    ),
    'modules'=>array(
        'users',
        'popups',
        
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'12345',
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
        ),
        
    ),

    
    // application components
    'components'=>array(
        'errorHandler'=>array(
            'errorAction'=>'popups/default/error',
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'autoRenewCookie' => true,
            'authTimeout' =>86400, //kills session after 15 min
        ),
        /**/
        //Session
        'session' => array(
            'autoStart'=>true, 
            'class' => 'CDbHttpSession',
            'timeout' => 86400, //here set session timeout
        ),
       
        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'=>'CProfileLogRoute',
                    'levels'=>'profile',
                    'enabled'=>true,
                    'class'     => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1'),
                    'levels' => 'errors',
                ),
            ),
        ), 
        // uncomment the following to enable URLs in path-format
        'widgetFactory' => array(
            'widgets' => array(
                'CGridView' => array(
                    'showTableOnEmpty' => true,
                    'cssFile' => false,
                    'selectableRows' => false,
                    'itemsCssClass' => 'table table-striped table-bordered table-condensed table-responsive table-project table-center',
                    'summaryText' => Yii::t('users', 'Показано {start}—{end} из {count}'),
                    'ajaxUpdate' => true,
                    'pagerCssClass' => 'text-center pagerCss',
                    'template' => "{items}\n{summary}\n{pager}",
                    'afterAjaxUpdate' => "function() {
                        $('.loading').hide();
                    }",
                    'beforeAjaxUpdate' => "function() {
                        $('.loading').show();
                    }",
                ),  
                'CLinkPager' => array(
                    'cssFile' => false,
                    'hiddenPageCssClass' => 'disable',
                    
                    'firstPageLabel' => '««',
                    'maxButtonCount' => 5,
                    'lastPageLabel' => '»»',
                    'prevPageLabel' => '«',
                    'nextPageLabel' => '»',
                    'header' => '',
                    'htmlOptions'=>array('class'=>'pagination')
                ),
                'CActiveForm' => array(
                    'method' => 'POST',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'errorMessageCssClass' => 'small text-danger',
                    'htmlOptions' => array('role' => 'form'),
                    'clientOptions' => array(
                        'errorCssClass' => 'has-error',
                        'successCssClass' => 'has-success',
                        'validatingCssClass' => 'has-warning',
                        'validateOnSubmit' => true,
                        'validateOnChange' => false,
                        'validateOnType' => false,
                    ),
                ),
            ),
        ),
        
        'clientScript'=>array(
           // 'class'=>'ext.NLSClientScript',
            'scriptMap'=>array(
                'jquery.js'=>false,
                'jquery.min.js'=>false,
                'jquery-ui.min.js'=>false,
                'jquery-ui-i18n.min.js'=>false,
                'jquery-ui.css' => false,
            ),
            'packages' => array(
                'select2' => array(
                    'baseUrl' => '/themes/demo/assets/plugins/select2/',
                    'js' => array('js/select2.full.min.js', 'js/i18n/ru.js'),
                    'css' => array('css/select2.min.css', 'css/select2-bootstrap.min.css', ),
                ),
            ),
            'defaultScriptFilePosition' => CClientScript::POS_END,
        ),
        'urlManager'=>array(
            'showScriptName'=>false,
            'urlFormat'=>'path',
            'rules'=>array(
                '/login'    => 'users/default/login',
                '/logout'   => 'users/default/logout',
                
                'popups/default/run/<id:\w+>' =>array('popups/default/run', 'urlSuffix' => '.js'),
                
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'   => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>'            => '<module>/<controller>/<action>',
            ),
        ),
        
        'db' => require(dirname(__FILE__) . '/db.php'),
        'cache'=>array(
            'class' =>'system.caching.CFileCache',
            'cachePath' =>'cache',
            'directoryLevel' => 1
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'version'  => '1.0',
        'adminEmail'=>'admin@admin.ru',
        'pageSize'=> 10
    ),
);