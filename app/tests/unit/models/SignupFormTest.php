<?php

namespace tests\unit\models;

use Yii;
use Codeception\Test\Unit;
use app\models\SignupForm;
use app\models\User;

class SignupFormTest extends Unit
{
    private $model;

    protected function _before()
    {
        User::deleteAll(['username' => 'testuser']);
        User::deleteAll(['email' => 'duplicate@example.com']);
        User::deleteAll(['username' => 'duplicateuser']);
    }

    public function testSignupValidData()
    {
        $this->model = new SignupForm([
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ]);

        $user = $this->model->signup();

        verify($user)->notNull();
        verify($user->username)->equals('testuser');
        verify($user->email)->equals('testuser@example.com');
        verify(Yii::$app->security->validatePassword('password123', $user->password_hash))->true();
        verify(User::find()->where(['username' => 'testuser'])->exists())->true();
    }

    public function testSignupInvalidData()
    {
        $this->model = new SignupForm([
            'username' => '',
            'email' => 'invalid-email',
            'password' => 'short',
        ]);

        $result = $this->model->signup();

        verify($result)->null();
        verify($this->model->errors)->arrayHasKey('username');
        verify($this->model->errors)->arrayHasKey('email');
        verify($this->model->errors)->arrayHasKey('password');
    }


    public function testSignupDuplicateEmail()
    {
        $existingUser = new User([
            'username' => 'existinguser',
            'email' => 'duplicate@example.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('password123'),
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);
        $existingUser->save();

        $this->model = new SignupForm([
            'username' => 'newuser',
            'email' => 'duplicate@example.com',
            'password' => 'password123',
        ]);

        $result = $this->model->signup();

        verify($result)->null();
        verify($this->model->errors)->arrayHasKey('email');
    }


    public function testSignupDuplicateUsername()
{
    $existingUser = new User([
        'username' => 'duplicateuser',
        'email' => 'duplicateuser@example.com',
        'password_hash' => Yii::$app->security->generatePasswordHash('password123'),
        'auth_key' => Yii::$app->security->generateRandomString(),
    ]);
    $existingUser->save();

    $this->model = new SignupForm([
        'username' => 'duplicateuser',
        'email' => 'newuser@example.com',
        'password' => 'password123',
    ]);

    $result = $this->model->signup();

    verify($result)->null();
    verify($this->model->errors)->arrayHasKey('username');
}

}
