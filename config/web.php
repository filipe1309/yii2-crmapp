<?php
return [
    'id' => 'crmapp', // mandatory identifier
    'basePath' => realpath(__DIR__ . '/../'), // mandatory
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
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
    ],
];