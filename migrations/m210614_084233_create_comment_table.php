<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m210614_084233_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment_table', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->string()->notNull(),
            'created_at' => $this->date()->notNull()
        ]);

        $this->addForeignKey(
            'task_id_fk', //"условное имя" ключа
            'comment_table', //название текущей таблицы
            'task_id', //имя поля в текущей таблице, которое будет ключом
            'task_table', //имя таблицы, с которой хотим связаться
            'id', //поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        $this->addForeignKey(
            'user_id_fk', //"условное имя" ключа
            'comment_table', //название текущей таблицы
            'user_id', //имя поля в текущей таблице, которое будет ключом
            'user_table', //имя таблицы, с которой хотим связаться
            'id', //поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comment_table');
        $this->dropForeignKey('task_id_fk', 'task_table');
        $this->dropForeignKey('user_id_fk', 'user_table');
    }
}
