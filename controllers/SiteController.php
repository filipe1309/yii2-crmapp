<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\log\Logger;
use app\models\user\LoginForm;

class SiteController extends Controller
{
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
}