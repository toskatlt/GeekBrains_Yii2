<?php

namespace app\controllers\actions\activity;

use app\models\Activity;
use yii\web\HttpException;
use yii\base\Action;

class ViewAction extends Action
{

    public function run($id)
    {

        $model = Activity::find()->andWhere(['id' => $id])->one();
        if (!$model) {
            throw new HttpException(404, 'activity not found');
        }

        if(!\Yii::$app->rbac->canEditViewActivity($model)) {
            throw new HttpException(403, 'Activity not for you');
        }

        return $this->controller->render('view', ['model' => $model]);
    }

}