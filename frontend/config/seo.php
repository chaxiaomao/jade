<?php

return [
    // 'user/signup' => '/site/signup',
    // 'user/login' => '/site/login',
    // 'user/logout' => '/site/logout',
    // 'user/forget-password' => '/site/forget-password',
    'center' => '/site/center',
    // 'user/kpi' => '/site/kpi',
    // 'user/profit' => '/site/profile',
    // 'user/kpi-verify' => '/site/kpi-verify',
    // 'user/kpi-commit' => '/site/kpi-commit',

    'user/<action:[\w\-]+>' => 'site/<action>',
    'user/<controller:[\w\-]+>/<action:[\w\-]+>' => 'site/<controller>/<action>',

];
