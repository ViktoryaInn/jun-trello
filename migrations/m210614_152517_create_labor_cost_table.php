<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%labor_cost}}`.
 */
class m210614_152517_create_labor_cost_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('labor_cost_table', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'time' => $this->time()->notNull(),
            'comment' => $this->string()
        ]);

        $this->addForeignKey(
            'task_id_fk_labor_cost', //"условное имя" ключа
            'labor_cost_table', //название текущей таблицы
            'task_id', //имя поля в текущей таблице, которое будет ключом
            'task_table', //имя таблицы, с которой хотим связаться
            'id', //поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        $this->addForeignKey(
            'user_id_fk_labor_cost', //"условное имя" ключа
            'labor_cost_table', //название текущей таблицы
            'user_id', //имя поля в текущей таблице, которое будет ключом
            'user_table', //имя таблицы, с которой хотим связаться
            'id', //поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        $this->dropColumn('task_table', 'duration_of_execution');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('labor_cost_table');
    }
}
