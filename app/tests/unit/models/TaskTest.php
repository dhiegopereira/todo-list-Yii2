<?php

namespace tests\unit\models;

use Yii;
use app\models\Task;
use app\models\User;
use Codeception\Test\Unit;

class TaskTest extends Unit
{
    private $model;
    private $user;

    protected function _before()
    {
        $this->user = new User([
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('password'),
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);
        $this->user->save();

        Yii::$app->user->login($this->user);
    }


    protected function _after()
    {
        Task::deleteAll();
        User::deleteAll();
    }

    public function testCreateTask()
    {
        $this->model = new Task([
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'status' => 'pending'
        ]);

        $result = $this->model->createTask();
        verify($result)->true();

        verify(Task::find()->where(['title' => 'Test Task'])->exists())->true();
    }

    public function testFindAllTasksByUser()
    {
        $task1 = new Task([
            'title' => 'Task 1',
            'description' => 'This is the first task',
            'status' => 'pending',
            'user_id' => $this->user->id,
        ]);
        $task1->save();

        $task2 = new Task([
            'title' => 'Task 2',
            'description' => 'This is the second task',
            'status' => 'completed',
            'user_id' => $this->user->id,
        ]);
        $task2->save();

        $tasks = Task::findAllTasksByUser();
        verify(count($tasks))->equals(2);
        verify($tasks[0]->title)->equals('Task 1');
        verify($tasks[1]->title)->equals('Task 2');
    }

    public function testFindTaskById()
    {
        // Cria uma tarefa para o teste
        $task = new Task([
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'status' => 'pending',
            'user_id' => $this->user->id,
        ]);
        $task->save();

        $foundTask = Task::findTaskById($task->id);

        $this->assertInstanceOf(Task::class, $foundTask);
        $this->assertEquals('Test Task', $foundTask->title);
    }

    public function testFindTaskByIdNotFound()
    {
        $this->expectException(\yii\web\NotFoundHttpException::class);
        Task::findTaskById(9999); 
    }

    public function testUpdateTask()
    {
        $task = new Task([
            'title' => 'Original Title',
            'description' => 'Original Description',
            'status' => 'pending',
            'user_id' => $this->user->id,
        ]);
        $task->save();

        $task->title = 'Updated Title';
        $task->description = 'Updated Description';
        $task->status = 'completed';

        $result = $task->updateTask();
        verify($result)->true();

        $updatedTask = Task::findOne($task->id);
        verify($updatedTask->title)->equals('Updated Title');
        verify($updatedTask->description)->equals('Updated Description');
        verify($updatedTask->status)->equals('completed');
    }

    public function testDeleteTaskById()
    {
        $task = new Task([
            'title' => 'Task to be deleted',
            'description' => 'This task will be deleted',
            'status' => 'pending',
            'user_id' => $this->user->id,
        ]);
        $task->save();

        Task::deleteTaskById($task->id);

        $deletedTask = Task::findOne($task->id);
        verify($deletedTask)->null();
    }


}
