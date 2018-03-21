<?php
return [
    'id' => 'crmapp', // mandatory identifier
    'basePath' => realpath(__DIR__ . '/../'), // mandatory
    'components' => [
        'request' => [
            'cookieValidationKey' => 'hakunamatata', // pk for "remember me" on auth
        ],
    ],
];