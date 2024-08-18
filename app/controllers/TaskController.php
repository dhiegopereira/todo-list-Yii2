<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;
use yii\data\ActiveDataProvider;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Redirecionar após salvar a tarefa
            return $this->refresh();
        }

        // Recupera as tarefas do usuário logado
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()->where(['user_id' => Yii::$app->user->id]),
        ]);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}
