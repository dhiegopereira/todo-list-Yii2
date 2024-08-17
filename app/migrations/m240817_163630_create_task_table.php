<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m240817_163630_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'due_date' => $this->dateTime(),
            'status' => "ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending'",
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-task-user_id',
            'task',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}
