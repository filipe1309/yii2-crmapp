<?php
namespace app\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\utilities\YamlResponseFormatter;
use app\models\service\ServiceRecord;

class ServicesController extends Controller
{
        
    public function actionJson()
    {
        $models = ServiceRecord::find()->all();
        $data = array_map(
            function ($model) { return $model->attributes; },
            $models
        );
        
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $data;
        
        return $response;
    }
    
    public function actionYaml()
    {
        $models = ServiceRecord::find()->all();
        $data = array_map(
            function ($model) { return $model->attributes; },
            $models
        );
        
        $response = Yii::$app->response;
        $response->format = YamlResponseFormatter::FORMAT;
        $response->data = $data;
        
        return $response;
    }
}
