<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m210613_174719_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task_table', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'executor_id' => $this->integer()->notNull(),
            'creation_date' => $this->date()->notNull(),
            'deadline_date' => $this->date()->notNull()
        ]);

        $this->addForeignKey(
            'status_id', //"условное имя" ключа
            'task_table', //название текущей таблицы
            'status_id', //имя поля в текущей таблице, которое будет ключом
            'status_table', //имя таблицы, с которой хотим связаться
            'id', //поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        $this->addForeignKey(
            'author_id', //"условное имя" ключа
            'task_table', //название текущей таблицы
            'author_id', //имя поля в текущей таблице, которое будет ключом
            'user_table', //имя таблицы, с которой хотим связаться
            'id', //поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        $this->addForeignKey(
            'executor_id', //"условное имя" ключа
            'task_table', //название текущей таблицы
            'executor_id', //имя поля в текущей таблице, которое будет ключом
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
        $this->dropTable('task_table');
        $this->dropForeignKey('status_id', 'status_table');
        $this->dropForeignKey('executor_id', 'user_table');
        $this->dropForeignKey('executor_id', 'user_table');
    }
}
