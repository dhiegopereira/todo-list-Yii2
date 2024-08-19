<?php

class SignupFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('sign-up');      
    }

    public function openTasksPage(\FunctionalTester $I)
    {
        $I->see('Criar conta');
    }

    public function signupWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->click('Cadastrar');
        $I->see('Username cannot be blank.');
        $I->see('Email cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function signupWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#signup-form', [
            'SignupForm[username]' => 'teste',
            'SignupForm[email]' => 'teste@exemplo.com',
            'SignupForm[password]' => '123',
        ]);
        $I->see('Password should contain at least 6 characters.');
    }

    public function signupSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#signup-form', [
            'SignupForm[username]' => 'teste',
            'SignupForm[email]' => 'teste@exemplo.com',
            'SignupForm[password]' => '123456',
        ]);
        $I->see('Login');
    }
}