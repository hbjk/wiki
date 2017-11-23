<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'dw-think',
    'defaultRoute' => 'be',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
//    'catchAll' => ['be/maintenance'],
    'components' => [
        'request' => [
            'csrfParam' => '_dw_csrf-think',
        ],

        'user' => [
            'class' => '\yii\web\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-be', 'httpOnly' => true],
            'loginUrl'  => ['be/login'],
        ],

        'session' => [
            'name' => 'be',
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
        'errorHandler' => [
            'errorAction' => 'be/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            //隐藏index.php
            'showScriptName' => false,
            //url后缀
//            'suffix' => '.html',
            'rules' => [
                [
                    'pattern'=>'<module:\w+>/<controller:\w+>/<action:\w+>/<search:\w*>/<page:\d*>/<sort:\S*>',
                    'route'=>'<module>/<controller>/<action>',
                    'defaults'=>['search'=>'', 'page'=>'', 'sort'=>''],
                ],

            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'qiniu' => [
            'class' => 'dcb9\qiniu\Component',
            'accessKey' => 'n5j4VXJ_mSrwQti7lx0kOB_Ii2pwiGT-W2Ibo4qq',
            'secretKey' => 'VRIm6w315KylXPhg3icq0WMYJxiy31CWoxftiE-b',
            'disks' => [
                'hbpublic' => [
                    'bucket' => 'hbpublic',
                    'baseUrl' => 'hbpublic.yandumall.com',
                    'isPrivate' => false,
                    'zone' => 'zone0', // 可设置为 zone0, zone1 @see \Qiniu\Zone
                ],
            ],
        ],
    ],
    'modules' => [
        'system' => [
            'class' => 'app\modules\system\Module',
        ],
        'admni' => [
            'class' => 'mdm\admin\Module',
//            'layout' => 'left-menu',
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'be/*',//允许访问的节点，可自行添加
            'admni/*',//允许所有人访问admin节点及其子节点
        ]
    ],
    'params' => $params,
];
