<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
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
            'LoginForm[username]' => 'diego',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->see('Incorrect username or password.');
    }


    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'diego',
            'LoginForm[password]' => '123456',
        ]);
        $I->see('Logout (diego)');
    }
}
