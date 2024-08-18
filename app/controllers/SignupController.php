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
            Yii::$app->session->setFlash('signupSuccess', 'Thank you for signing up. You can now login.');
            return $this->redirect(['login/index']);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
