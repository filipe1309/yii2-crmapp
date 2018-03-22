<?php
$db_config = parse_ini_file(__DIR__ . '/db_config.ini');

return [
    'class' => $db_config['class'],
    'dsn' => $db_config['dsn'],
    'username' => $db_config['username'],
    'password' => $db_config['password'],
];