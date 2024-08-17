<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\LoginForm;

class LoginController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'tasks'],
                'rules' => [
                    [
                        'actions' => ['tasks'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/tasks']);
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/tasks']);
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    public function actionTasks()
    {
        // Aqui você irá renderizar a view das tarefas
        return $this->render('tasks');
    }
}
