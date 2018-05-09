<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class HashController extends Controller
{
    public function actionIndex($string)
    {
        if ($this->interactive)
            Console::output(sprintf('Input string was: %s', $string));
        
        Console::output(Yii::$app->security->generatePasswordHash($string));
    }
}
