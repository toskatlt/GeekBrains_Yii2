<?php

namespace app\components;

use app\models\Activity;
use app\rules\OwnerActivityRule;
use yii\base\Component;
use yii\rbac\ManagerInterface;

class RbacComponent extends Component
{
    public function getAuthManager(): ManagerInterface
    {
        return \Yii::$app->authManager;
    }

    public function genRbac()
    {
        $authManager = $this->getAuthManager();
        $authManager->removeAll();

        $admin = $authManager->createRole('admin');
        $admin->description = 'Роль админа';
        $authManager->add($admin);

        $user = $authManager->createRole('user');
        $user->description = 'Роль пользователя';
        $authManager->add($user);

        $createActivity = $authManager->createPermission('createActivity');
        $createActivity->description = 'Создание активности';
        $authManager->add($createActivity);

        $createViewOwnerActivity = $authManager->createPermission('createViewOwnerActivity');
        $createViewOwnerActivity->description = 'Просмотр и редактирование своих активностей';

        $rule=new OwnerActivityRule();
        $createViewOwnerActivity->ruleName=$rule->name;

        $authManager->add($rule);
        $authManager->add($createViewOwnerActivity);

        $createViewAllActivity = $authManager->createPermission('createViewAllActivity');
        $createViewAllActivity->description = 'Просмотр и редактирование любых активностей';
        $authManager->add($createViewAllActivity);

        $authManager->addChild($user, $createActivity);
        $authManager->addChild($user, $createViewOwnerActivity);
        $authManager->addChild($admin, $user);
        $authManager->addChild($admin, $createViewAllActivity);

        $authManager->assign($admin, 2);
        $authManager->assign($user, 1);
    }

    public function canCreateActivity(): bool
    {
        return \Yii::$app->user->can('CreateActivity');
    }

    public function canEditViewActivity(Activity $activity) {
        if(\Yii::$app->user->can('createViewAllActivity')) {
            return true;
        }

        if(\Yii::$app->user->can('createViewOwnerActivity', ['activity' => $activity])) {
            return true;
        }

        return false;
    }
}
