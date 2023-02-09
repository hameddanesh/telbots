<?php

$database = array();
$database['dbms'] = 'mysql';
$database['host'] = 'localhost';
$database['dbname'] = 'telbots_db';
$database['username'] = 'root';
$database['password'] = '';
$database['charset'] = 'utf8mb4';

define('DATABASE', $database);
define('BOT_TOKEN', '');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
