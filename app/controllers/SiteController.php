<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\Task;
use app\models\TaskList;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('signupSuccess', 'Thank you for signing up. You can now login.');
            return $this->render('signup');
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionTask()
    {
        // Verifica se o usuário está logado
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']); // Redireciona para o login se o usuário não estiver logado
        }

        // Obtém o ID do usuário logado
        $userId = Yii::$app->user->id;

        // Cria uma nova instância do modelo TaskList
        $model = new TaskList();

        // Se o formulário foi enviado e os dados foram carregados no modelo
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Aqui você pode salvar a tarefa no banco de dados
            // (Isso seria feito em um modelo de ActiveRecord, que não está presente neste exemplo)

            // Exemplo: salvando a tarefa (supondo que você tenha um modelo de ActiveRecord para as tarefas)
            // $task = new Task();
            // $task->user_id = $userId;
            // $task->title = $model->task;
            // $task->due_date = $model->dueDate;
            // $task->priority = $model->priority;
            // $task->status = $model->status;
            // $task->save();

            // Flash message para indicar sucesso
            Yii::$app->session->setFlash('taskAdded', 'Task added successfully.');
        }

        // Renderiza a view 'task' com o modelo
        return $this->render('task', [
            'model' => $model,
        ]);
    }


}
