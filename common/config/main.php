<?php
defined('PROJECT_ROOT') or define('PROJECT_ROOT', dirname(dirname(__DIR__)));

$vendorDir = PROJECT_ROOT . '/vendor';

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'version' => '1.0.0',
    'charset' => 'UTF-8',
    'vendorPath' => $vendorDir,
    'extensions' => require($vendorDir . '/cza/yii2-base/extensions.php'),
    'components' => [
        'settings' => ['class' => 'common\components\Settings',],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'sms' => [
            'class' => 'common\components\Sms\WxtSms2',
            'userid' => 216,
            'account' => 'SDK-A150-330',
            'password' => '0000',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app.c2' => 'c2.php',
                        'app.sms' => 'sms.php',
                        'app.rest' => 'rest.php',
                    ],
                ],
            ],
        ],
    ],
];
