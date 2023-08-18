<?php

$database = array();
$database['dbms'] = 'mysql';
$database['host'] = 'localhost';
$database['dbname'] = '';
$database['username'] = 'root';
$database['password'] = '';
$database['charset'] = 'utf8mb4';

$config = array();
$config['DATABASE'] = $database;
$config['BOT_TOKEN'] = '';
$config['API_URL'] = 'https://api.telegram.org/bot' . $config['BOT_TOKEN'] . '/';