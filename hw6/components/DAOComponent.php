<?php


namespace app\components;

use yii\db\Connection;

class DAOComponent
{
    private function getConnection()
    {
        return \Yii::$app->db;
    }


}