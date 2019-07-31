<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $token
 * @property string $auth_key
 * @property string $create_at
 *
 * @property Activity[] $activities
 */
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password_hash', 'create_at'], 'required'],
            [['create_at'], 'safe'],
            [['email', 'password_hash', 'token', 'auth_key'], 'string', 'max' => 50],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'token' => Yii::t('app', 'Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'create_at' => Yii::t('app', 'Create At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities() {
        return $this->hasMany(Activity::className(), ['user_id' => 'id']);
    }
}
