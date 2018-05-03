<?php

namespace app\components;

use yii\base\Component;
use yii\base\Event;

class MyEvent extends Component
{
    const EVENT_HELLO = 'hello';

    public function triggerEventHello()
    {
        $this->trigger(self::EVENT_HELLO);
    }
}