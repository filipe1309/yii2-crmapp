<?php
return [
    'id' => 'crmapp-console',
    //'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\commands',
    'components' => [
        //'db' => require(__DIR__ . '/db.php'),
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'templateFile' => '@app/views/layouts/migration.php'
        ]
    ]
];
