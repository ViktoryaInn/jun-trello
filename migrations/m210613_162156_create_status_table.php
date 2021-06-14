<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m210613_162156_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('status_table', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()
        ]);

        $this->insert('status_table', [
            'name' => 'created',
        ]);

        $this->insert('status_table', [
            'name' => 'in_progress',
        ]);

        $this->insert('status_table', [
            'name' => 'completed',
        ]);

        $this->alterColumn('user_table', 'login', 'string not null unique');

        $this->alterColumn('user_table', 'password', 'string not null');

        $this->alterColumn('user_table', 'created_at', 'date not null');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('status_table', ['id' => 1]);
        $this->delete('status_table', ['id' => 2]);
        $this->delete('status_table', ['id' => 3]);
        $this->dropTable('status_table');
    }
}
