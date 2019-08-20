<?php

namespace app\base;

use yii\web\Controller;
use yii\web\HttpException;

class BaseController extends Controller
{
    public function beforeAction($action)
    {

        if (\Yii::$app->user->isGuest) {
            throw new HttpException( 401, 'Need Auth');
        }
        $lastUrl = \Yii::$app->session->get('last_url');
//    echo "<br><br><br>" . "<h1 style='text-align: center'>$lastUrl</h1>";
        \Yii::$app->session->set('last_url', \Yii::$app->request->absoluteUrl);

        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        \Yii::$app->session->setFlash('prev_page',\Yii::$app->request->absoluteUrl);
        return parent::afterAction($action, $result);
    }

}