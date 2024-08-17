<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * TaskList is the model behind the task list form.
 */

class TaskList extends Model
{
    public $task;
    public $dueDate;
    public $priority;
    public $status;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // task, dueDate, priority, and status are required
            [['task', 'dueDate', 'priority', 'status'], 'required'],
            // dueDate has to be a valid date
            ['dueDate', 'date'],
            // priority has to be a valid integer
            ['priority', 'integer'],
            // status has to be a valid string
            ['status', 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'task' => 'Task',
            'dueDate' => 'Due Date',
            'priority' => 'Priority',
            'status' => 'Status',
        ];
    }

    /**
     * Saves the task list to the database.
     * @return bool whether the model passes validation
     */
    public function save()
    {
        if ($this->validate()) {
            // Save the task list to the database
            return true;
        }
        return false;
    }
}