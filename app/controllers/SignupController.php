<?php

use Yii;
use yii\web\Controller;
use app\models\SignupForm;

class SignUpController extends Controller
{
    public function index()
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
}