<?php
// Set debug mode
define('YII_DEBUG', true);

// Composer autoload
require(__DIR__ . '/../vendor/autoload.php');

// Including the Yii framework itsolf
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

// Override display_errors
ini_set('display_errors', true);

// Getting hte configuration
$config = require(__DIR__ . '/../config/web.php');

// Making and launching the application immediatily
(new yii\web\Application($config))->run();