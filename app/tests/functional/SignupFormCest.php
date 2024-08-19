<?php

class SignupFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('login');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'diego',
            'LoginForm[password]' => '123456',
        ]);
    }

    public function openTasksPage(\FunctionalTester $I)
    {
        $I->see('Logout (diego)');
        $I->see('Gerenciamento de Tarefas');
    }

    public function createTask(\FunctionalTester $I)
    {
        $I->submitForm('#task-form', [
            'Task[title]' => 'Teste',
            'Task[description]' => 'Teste de descrição',
        ]);
        $I->see('Teste');
        $I->see('Teste de descrição');
    }

    public function updateTask(\FunctionalTester $I)
    {
        $I->submitForm('#task-form', [
            'Task[title]' => 'Teste',
            'Task[description]' => 'Teste de descrição',
        ]);
     
        $I->click(['link' => 'Editar']); 
        $I->submitForm('#task-form', [
            'Task[title]' => 'Teste Atualizado',
            'Task[description]' => 'Teste de descrição atualizado',
        ]);
        $I->see('Teste Atualizado');
        $I->see('Teste de descrição atualizado');
    }

    public function deleteTask(\FunctionalTester $I)
    {
        $I->submitForm('#task-form', [
            'Task[title]' => 'Teste',
            'Task[description]' => 'Teste de descrição',
        ]);
        $I->see('Teste');
        $I->see('Teste de descrição');
        
        $I->click(['link' => 'Excluir']); 
        $I->dontSee('Teste Atualizado');
        $I->dontSee('Teste de descrição atualizado');
    }
}