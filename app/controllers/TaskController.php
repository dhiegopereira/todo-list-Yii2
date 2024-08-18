<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;

class TaskController extends Controller
{


    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/login']);
        }

        $model = new Task();
        $tasks = Task::findAllTasks();

        return $this->render('index', [
            'model' => $model,
            'tasks' => $tasks,
        ]);
    }

    public function actionCreate()
    {
        $model = new Task();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->createTask()) {
            Yii::$app->session->setFlash('taskSuccess', 'Task has been added successfully.');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('taskError', 'Error adding task.');
            $tasks = Task::findAllTasks();
            return $this->render('index', [
                'model' => $model,
                'tasks' => $tasks,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tasks = Task::findAllTasks();

        if ($model->load(Yii::$app->request->post()) && $model->updateTask()) {
            Yii::$app->session->setFlash('taskSuccess', 'Task has been updated successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'model' => $model,
            'tasks' => $tasks,
        ]);
    }


    public function actionDelete($id)
    {
        if (Yii::$app->request->isPost) {
            $model = Task::findOne($id);

            if ($model) {
                $model->deleteTaskById($id);

                Yii::$app->session->setFlash('taskSuccess', 'Tarefa excluída com sucesso.');
            } else {
                Yii::$app->session->setFlash('taskError', 'Tarefa não encontrada.');
            }

            return $this->redirect(['index']);
        }

        Yii::$app->session->setFlash('taskError', 'Requisição inválida.');
        return $this->redirect(['index']);
    }




    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
