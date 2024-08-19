<?php

namespace tests\unit\models;

use app\models\User;
use app\models\Task;

class TaskTest extends \Codeception\Test\Unit
{
    private $model;

    protected function _after()
    {
        \Yii::$app->user->logout();
    }

    public function testeFindAllTasks()
    {
        $this->model = new Task([
            'title' => 'Task 1',
            'description' => 'Description 1',
            'status' => 'status 1',
            'user_id' => 1,
        ]);

        verify($this->model->createTask())->true();
        verify($this->model->id)->notEmpty();

        $this->model = new Task([
            'title' => 'Task 2',
            'description' => 'Description 2',
            'status' => 'status 2',
            'user_id' => 2,
        ]);

        verify($this->model->createTask())->true();
        verify($this->model->id)->notEmpty();

        $tasks = Task::findAllTasks();
        verify($tasks)->notEmpty();
        verify(count($tasks))->equals(2);
    }
}