<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 15:47
 */

return [
    'lord' => [
        'class' => 'frontend\modules\Lord\Module',
    ],
    'elder' => [
        'class' => 'frontend\modules\Elder\Module',
    ],
    'chieftain' => [
        'class' => 'frontend\modules\Chieftain\Module',
    ],
    'master' => [
        'class' => 'frontend\modules\Master\Module',
    ],
    'familiar' => [
        'class' => 'frontend\modules\Familiar\Module',
    ],
    'peasant' => [
        'class' => 'frontend\modules\Persant\Module',
    ],

    'log-reader' => [
        'class' => 'zhuravljov\yii\logreader\Module',
        'aliases' => [
            'backend Errors' => '@backend/runtime/logs/backend_debug.log',
            'backend Info' => '@backend/runtime/logs/backend_info.log',
            'Console Errors' => '@backend/runtime/logs/app.log',

        ],
    ],
];