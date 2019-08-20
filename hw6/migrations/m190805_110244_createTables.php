<?php

use yii\db\Migration;

/**
 * Class m190805_110244_createTables
 */
class m190805_110244_createTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'description' => $this->text(),
            'dateStart' => $this->date()->notNull(),
            'dateEnd' => $this->date(),
            'isBlocked' => $this->tinyInteger()->notNull()->defaultValue(0),
            'email' => $this->string(150),
            'useNotification' => $this->tinyInteger()->notNull()->defaultValue(0),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'password_hash' => $this->string(300)->notNull(),
            'token' => $this->string(150),
            'auth_key' => $this->string(150),
            'createAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190805_110244_createTables cannot be reverted.\n";

        return false;
    }
    */
}
