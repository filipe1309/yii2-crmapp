<?php

namespace app\utilities;

use yii\web\UrlRuleInterface;
use app\models\user\UserRecord;

class UsernameUrlRule implements UrlRuleInterface
{
    public function parseRequest($manager, $request)
    {
        $maybeUsername = str_replace('users/view/', '', $request->pathInfo);

        $user = UserRecord::findOne(['username' => $maybeUsername]);
        if (!$user)
            return false;

        $route = 'users/view';
        $params = ['id' => $user->id];
        return [$route, $params];
    }
    
    public function createUrl($manager, $route, $params)
    {
        if ($route !== 'users/view' || !array_key_exists('id', $params))
            return false;

        $user = UserRecord::findOne($params['id']);
        if (!$user)
            return false;

        return "users/view/{$user->username}";
    }
}
