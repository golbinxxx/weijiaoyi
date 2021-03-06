<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
//    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-home',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'home\controllers',
    'bootstrap' => bootstrap_filter(['admin'], ['log']),
    'modules' => [
        'admin' => 'admin\Module',
        'pcwebsite' => [
            'class' => 'app\modules\pcwebsite\Pcwebsite', 
         ],
    ],

    'components' => [
        'user' => [
            'loginUrl' => is_access_admin() ? ['admin/site/login'] : ['site/login'],
            'identityClass' => is_access_admin() ? 'admin\components\AdminWebUser' : 'home\components\WebUser'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => is_access_admin() ? '@runtime/logs/admin.log' : '@runtime/logs/home.log',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:403',
                        'yii\web\HttpException:404'
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
    ],
    'params' => $params
];
