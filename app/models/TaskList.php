<?php

namespace app\models;

use Yii;
use yii\base\Model;

class TaskList extends Model
{
    public $task;
    public $dueDate;
    public $priority;
    public $status;

    public function rules()
    {
        return [
            [['task', 'dueDate', 'priority', 'status'], 'required'],
            ['dueDate', 'date'],
            ['priority', 'integer'],
            ['status', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'task' => 'Task',
            'dueDate' => 'Due Date',
            'priority' => 'Priority',
            'status' => 'Status',
        ];
    }

    // Você pode adicionar métodos adicionais aqui se necessário
}
