<?php

namespace app\controllers\actions\activity;

use app\models\Activity;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

class CreateAction extends Action
{
    public $classEntity;

    public function run()
    {
        /** @var Activity $activity */
        $activity = \Yii::$app->activity->getEntity();

        if (\Yii::$app->request->isPost) {
            $activity->load(\Yii::$app->request->post());

            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($activity);
            }

            if (\Yii::$app->activity->createActivity($activity)) {
//        return$this->controller->redirect('/');
                return $this->controller->render('view',['model'=>$activity]);
            }
        }

        $arr=['one'=>'va;1','two'=>['three'=>'val3']];

        $db=[['id'=>1,'name'=>'Helena','type'=>'sister'],['id'=>2,'name'=>'Serge', 'type'=>'bro']];

        $val=ArrayHelper::getValue($arr,'two.three');
        $lids=ArrayHelper::map($db,'id',function ($data){
            return ArrayHelper::getValue($data,'type').' '.
                ArrayHelper::getValue($data,'name');
        });
        

//        print_r($lids);exit;
//
//        echo $val;exit;

        return $this->controller->render('create', ['model' => $activity]);
    }
}