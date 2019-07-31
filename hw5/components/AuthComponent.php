<?php


namespace app\components;


use app\models\Users;
use yii\base\Component;

class AuthComponent extends Component
{
    public function signUp(Users $model): bool
    {
        if(!$model->validate(['email','password'])) {
            return false;
        }

        $model->password_hash = $this->generateHashPassword($model->password);
        $model->auth_key = $this->generateAuthKey();

        if($model->save()) {
            return true;
        }

        return false;
    }

    public function generateAuthKey(): string
    {

        return \Yii::$app->security->generateRandomString();

    } 

    private function generateHashPassword(string $password): string {

        return \Yii::$app->security->generatePasswordHash($password);

    }
}