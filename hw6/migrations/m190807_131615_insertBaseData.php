<?php

use yii\db\Migration;

/**
 * Class m190807_131615_insertBaseData
 */
class m190807_131615_insertBaseData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*
        $this->insert('users', [
            'id'=> 1,
            'email'=>'test1@test.ru',
            'password_hash' => 'asasdf',
        ]);
        //$this->insert('users', [
            'id'=> 2,
            'email'=>'test2@test.ru',
            'password_hash' => 'asasdf',
        ]);
        */

        $this->batchInsert('activity', ['title', 'user_id','dateStart','useNotification', 'email'], [
            ['title 1',1,date('Y-m-d'),0,null],
            ['title 2',2,date('Y-m-d'),0,null],
            ['title 3',2,date('Y-m-d'),1,null],
            ['title 4',2,date('Y-m-d'),1,null],
            ['title 5',1,'2019-07-20',1,null],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->delete('users');
        $this->delete('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190807_131615_insertBaseData cannot be reverted.\n";

        return false;
    }
    */
}
