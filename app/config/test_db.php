<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'mysql:host=localhost;dbname=yii2db';
$db['username'] = 'yii2user';
$db['password'] = 'yii2password';
$db['charset'] = 'utf8';

return $db;
