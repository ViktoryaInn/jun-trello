<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210613_154240_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_table', [
            'id' => $this->primaryKey(),
            'login' => $this->string(),
            'password' => $this->string(),
            'created_at' => $this->date()
        ]);

        $this->insert('user_table', [
            'login' => 'homeless_narcissus',
            'password' => '123456',
            'created_at' => '2021-06-13'
        ]);

        $this->insert('user_table', [
            'login' => 'vita_kolf',
            'password' => '654321',
            'created_at' => '2021-06-13'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user_table', ['id' => 1]);
        $this->delete('user_table', ['id' => 2]);
        $this->dropTable('user_table');
    }
}
