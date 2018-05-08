<?php
return [
    'id' => 'crmapp', // mandatory identifier
    'basePath' => realpath(__DIR__ . '/../'), // mandatory
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['debug'],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*']
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
        'firstlevel' => [
            'class' => 'app\utilities\FirstModule',
            'modules' => [
                'secondlevel' => [
                    'class' => 'app\utilities\SecondModule'
                ]
            ]
        ],
        'api' => [
            'class' => 'app\api\ApiModule'
        ]
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'hakunamatata', // pk for "remember me" on auth
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'customer/<id:\d+>' => 'customer-records/view'
            ]
        ],
        'db' => require(__DIR__ . '/db.php'),
        'view' => [
            'renderers' => [
                // Files using md extension
                'md' => [
                    // MD Renderer
                    // Class to render files from this entesion
                    'class' => 'app\utilities\MarkdownRenderer'
                ]
            ],
            'theme' => [
                'class' => yii\base\Theme::className(),
                'basePath' => '@app/themes/snowy'
            ]
        ],
        'response' => [
            'formatters' => [
                'yaml' => [
                    'class' => 'app\utilities\YamlResponseFormatter'
                ]
            ]
        ],
        'user' => [
            'identityClass' => 'app\models\user\UserRecord'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest']
        ],
        'mail' => [
            'class' => yii\swiftmailer\Mailer::className(),
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => 'noreply@crmapp.me'
            ],
            'transport' => [
                'class' => 'Swift_MailTransport'
            ]
        ]/*,
        'errorHandler' => [
            'errorAction' => 'site/error'
        ]*/
        ,
        'mycache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@webroot/mycache'
        ],
        'assetManager' => [
            'bundles' => (require __DIR__ . '/assets_compressed.php')
        ],
    ],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php')
    /*
    // Extension manual loading code example
    'extensions' => array_merge(
        (require __DIR__ . '/../vendor/yiisoft/extensions.php'),
        [
            'malicious\app-info' => [
                'name' => 'Application Information Dumper',
                'version' => '1.0.0',
                'bootstrap' => '\malicious\Bootstrap',
                'alias' => ['@malicious' =>
                '/some/filesystem/path']
                // that's the path to extension
            ]
        ]
    )
    */
];
