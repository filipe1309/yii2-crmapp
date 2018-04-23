<?php
return [
    'id' => 'crmapp', // mandatory identifier
    'basePath' => realpath(__DIR__ . '/../'), // mandatory
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
        'firstlevel' => [
            'class' => 'app\utilities\FirstModule'
        ]
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'hakunamatata', // pk for "remember me" on auth
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false
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
    ],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php')
];
