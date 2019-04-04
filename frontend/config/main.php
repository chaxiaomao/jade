<?php
defined('CZA_FRONTEND_THEME') or define('CZA_FRONTEND_THEME', 'sunflower');
$params = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/params.php')
);
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' => 'zh-CN',
    'bootstrap' => ['log','log-reader'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => require(__DIR__ . '/modules.php'),
    'components' => [
        'formatter' => [
            'dateFormat' => 'Y-M-d',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'class' => 'frontend\components\User',
            'identityClass' => 'common\models\c2\entity\FeUserModel',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                //                [
                //                    'class' => 'yii\log\FileTarget',
                //                    'levels' => ['error', 'warning'],
                //                ],
                'frontendLog' => [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => "@runtime/logs/frontend_info.log",
                    'categories' => ['application'],
                    'levels' => ['info', 'trace'],
                    // belows setting will keep the log fresh
                    'maxFileSize' => 0,
                    'maxLogFiles' => 0,
                ],
                'frontendDebugLog' => [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => "@runtime/logs/frontend_debug.log",
                    'categories' => ['debug'],
                    'levels' => ['info'],
                    // belows setting will keep the log fresh
                    //                    'maxFileSize' => 0,
                    //                    'maxLogFiles' => 0,
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/' . CZA_FRONTEND_THEME,
                'baseUrl' => '@web/themes/' . CZA_FRONTEND_THEME,
                'pathMap' => [
                    '@app/views' => ['@app/themes/' . CZA_FRONTEND_THEME,],
                    '@app/modules' => '@app/themes/' . CZA_FRONTEND_THEME . '/modules', // module's theme
                    '@app/widgets' => '@app/themes/' . CZA_FRONTEND_THEME . '/widgets', // widget's theme
                ],
            ],
        ],
    ],
    'params' => $params,
];
