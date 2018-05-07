<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\log\Logger;
use app\models\user\LoginForm;
use app\models\user\UserRecord;

class SiteController extends Controller
{
    /*public function actions()
    {
        return [
            // Create an action to error route
            // the other option is to actually create 
            // the view views/site/error.php and use $name, $message and
            // $exception params to descrive the error in a custom view
            // if the view is created, yii2 will use this view, 
            // if not yii2 will use the error defult view
            'error' => ['class' => 'yii\web\ErrorAction']
        ];
    }*/
    
    public function actionIndex()
    {
        return $this->render('homepage');
    }
    
    public function actionDocs()
    {
        return $this->render('docindex.md');
    }
    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
            return $this->goHome();
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) and $model->login())
            return $this->goBack();
        
        return $this->render('login', compact('model'));
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    
    public function actionProfile()
    {
        Yii::beginProfile('outer', 'beginning');
        
        Yii::getLogger()->log('first', Logger::LEVEL_PROFILE);
        Yii::trace('second');
        Yii::info('third');
        
        Yii::beginProfile('inner', 'beginning');
        
        Yii::warning('fourth', 'nonapplication');
        Yii::info('fifth');
        
        Yii::endProfile('inner', 'ending');
        
        Yii::endProfile('outer', 'ending');
        
        $result = Yii::$app->response;
        $result->data = Yii::getLogger()->getProfiling(
            ['beginning', 'application', 'ending']
        );
        $result->format = Response::FORMAT_JSON;
        
        return $result;
    }
    
    /*
    public function actionShowError()
    {
        throw new \yii\base\ErrorException("Custom error action");
    }
    
    // Create an action to error route
    // It's equivalent to use 'error' in actions method
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }
    */
    
    public function actionBehavior()
    {
        $user = new UserRecord();
        $user->prop1 = 'foo';
        $behavior = $user->getBehavior('myBehavior');
        $behaviors = $user->getBehaviors();
        return $behavior::className() . ': ' . $user->prop1 . $user->foo();
        
        /*
        // attach a behavior object
        $component->attachBehavior('myBehavior1', new MyBehavior);
        
        // attach a behavior class
        $component->attachBehavior('myBehavior2', MyBehavior::className());
        
        // attach a configuration array
        $component->attachBehavior('myBehavior3', [
            'class' => MyBehavior::className(),
            'prop1' => 'value1',
            'prop2' => 'value2',
        ]);
        
        // attach multiple behaviors
        $component->attachBehaviors([
            'myBehavior1' => new MyBehavior,  // a named behavior
            MyBehavior::className(),          // an anonymous behavior
        ]);
        
        // In configuration
        [
            'as myBehavior2' => MyBehavior::className(),
        
            'as myBehavior3' => [
                'class' => MyBehavior::className(),
                'prop1' => 'value1',
                'prop2' => 'value2',
            ],
        ]
        
        $component->detachBehavior('myBehavior1');
        $component->detachBehaviors();
        
        */
    }
    
    public function actionEvent()
    {
        $myEvent = new \app\components\MyEvent;
        $myEvent->on(\app\components\MyEvent::EVENT_HELLO, function ($event) {
            echo '<pre>';
            var_dump($event);
        }, 'abc');
        
        $myEvent->triggerEventHello();
    }
    
    public function actionWidgets()
    {
        return $this->render('widgets');
    }
}
