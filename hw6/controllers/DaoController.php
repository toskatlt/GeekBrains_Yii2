<?php


namespace app\controllers;


use app\base\BaseController;

class DaoController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}