<?php
namespace app\controllers;
use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\controllers\actions\activity\ViewAction;
use app\models\Activity;

class ActivityController extends BaseController
{
  public function actions()
  {
    return [
        'create' => ['class' => CreateAction::class, 'classEntity' => Activity::class],
        'new' => ['class' => CreateAction::class, 'classEntity' => Activity::class],
        'view' => ['class' => ViewAction::class]
    ];
  }
}