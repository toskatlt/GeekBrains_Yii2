<?php


namespace app\rules;

use app\models\Activity;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\rbac\Rule;

class OwnerActivityRule extends Rule
{
    public $name='ownerActivityRule';

    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     * @throws \Exception
     */
    public function execute($user, $item, $params)
    {
        /** @var Activity $activity */
        $activity = ArrayHelper::getValue($params, 'activity');
        if (!$activity) {
            throw new \Exception('need activity param in rule');
        }

        return $user == $activity->user_id;
    }
}