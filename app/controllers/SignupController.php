<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SignupForm;

class SignUpController extends Controller
{
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['task/index']);
        }

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('signupSuccess', 'Obrigado por se cadastrar! Faça login para acessar o sistema.');
            return $this->redirect(['login/index']);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
