<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('login');

        $user = new \app\models\User();
        $user->username = 'teste';
        $user->email = 'teste@exemplo.com';
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save();
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Entrar', 'h1');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->amOnPage('/index-test.php?r=login');
        $I->see('Login');
        $I->click('Entrar');
        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'teste',
            'LoginForm[password]' => 'senha_errada',
        ]);
        $I->see('Usuário ou senha inválido.');
    }


    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'teste',
            'LoginForm[password]' => '123456',
        ]);
        $I->see('Logout (teste)');
    }

    public function logout(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'teste',
            'LoginForm[password]' => '123456',
        ]);
        $I->click('.logout');
        $I->seeInCurrentUrl('/');
    }
}
