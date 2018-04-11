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
            ]
        ],
        'response' => [
            'formatters' => [
                'yaml' => [
                    'class' => 'app\utilities\YamlResponseFormatter'
                ]
            ]
        ]
    ],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php')
];
