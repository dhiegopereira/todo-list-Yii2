## Desafio Técnico de Codificação

<details>
<summary>Configuração do ambiente com Docker </summary>

> `OBS:` É obrigatório ter o docker instalado, caso não tenha, clique [aqui](https://www.docker.com/get-started/)

> No ambiente com o docker, já vem configurado o serviço do MySQL e PhpMyAdmin, você pode conferir clicando [aqui](./docker-compose.yml)


1º Passo: Clonar o repositório
```cmd
git clone git@github.com:dhiegopereira/todo-list-Yii2.git
```
2º Passo: Acessar a pasta do projeto
```cmd
cd todo-list-Yii2
```
3º Passo: Executar com o docker composer
```cmd
docker composer up -d 
```
4º Passo: Acessar a aplicação

> http://localhost:8080 

5º Passo: Acessar o PhpMyAdmin

> http://localhost:8081 

</details>
---

<details>
<summary>Configuração do ambiente sem Docker</summary>

> `OBS:` Para esse ambiente, deve instalar o MySQL, pois é o banco que será utilizando na aplicação

1º Passo: Clonar o repositório
```cmd
git clone git@github.com:dhiegopereira/todo-list-Yii2.git
```
2º Passo: Instalação das depedências do projeto
```cmd
composer install
```
3º Passo: Executar as migrações do banco
```cmd
php yii migrate
```
4º Passo: Iniciar a aplicação
```cmd
php yii serve
```
5º Passo: Acessar sua aplicação

> http://localhost:8080 
</details>

---

#### Configuração do banco
```php
<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=db;dbname=yii2db',
    'username' => 'yii2user',
    'password' => 'yii2password',
    'charset' => 'utf8',
];
```
Acesse clicando [aqui](./app/config/db.php)

---

#### Executar os testes

```cmd
endor/bin/codecept run
```

---
### Extras
- [Pipeline para testes](.github/workflows/test.yml)
- [Pipeline para deploy](.github/workflows/deploy.yml)
- [Deploy da aplicação](http://172.191.49.248:8080/)
- [Vídeo de demostração](https://drive.google.com/file/d/1g7lGHCVs4i6vBNRzgvduKJHdSyG98Ev3/view?usp=sharing)
