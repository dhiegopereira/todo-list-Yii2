<?php

namespace tests\unit\models;

use Yii;
use app\models\User;
use app\models\LoginForm;

class LoginFormTest extends \Codeception\Test\Unit
{
    private $model;
    protected function _before()
    {
        $user = new User([
            'username' => 'teste',
            'email' => 'teste@exemplo.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);
        $user->save();
    }

    protected function _after()
    {
        Yii::$app->user->logout();
    }

    public function testLoginNoUser()
    {
        $this->model = new LoginForm([
            'username' => 'usuario_nao_existente',
            'password' => 'senha_errada',
        ]);

        verify($this->model->login())->false();
        verify(Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $this->model = new LoginForm([
            'username' => 'teste',
            'password' => 'senha_errada',
        ]);

        verify($this->model->login())->false();
        verify(Yii::$app->user->isGuest)->true();
        verify($this->model->errors)->arrayHasKey('password');
    }

    public function testLoginCorrect()
    {
        $this->model = new LoginForm([
            'username' => 'teste',
            'password' => '123456',
        ]);

        verify($this->model->login())->true();
        verify(Yii::$app->user->isGuest)->false();
        verify($this->model->errors)->arrayHasNotKey('password');
    }

}
