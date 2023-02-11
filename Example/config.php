<?php

$database = array();
$database['dbms'] = 'mysql';
$database['host'] = 'localhost';
$database['dbname'] = 'botdb';
$database['username'] = 'root';
$database['password'] = '';
$database['charset'] = 'utf8mb4';

define('DATABASE', $database);
define('BOT_TOKEN', '5602279912:AAE-kkM5JLQUr1r6XNMkwQ1Ndwc5AZK67S0');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
