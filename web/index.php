<?php
// Including the Yii framework itsolf
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
// Getting hte configuration
$config = require(__DIR__ . '/../config/web.php');
// Making and launching the application immediatily
(new yii\web\Application($config))->run();