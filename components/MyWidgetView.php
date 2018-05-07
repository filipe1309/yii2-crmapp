<?php

namespace app\components;

use yii\base\Widget;

class MyWidgetView extends Widget
{
    
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        return $this->render('widget_view');
    }
}
