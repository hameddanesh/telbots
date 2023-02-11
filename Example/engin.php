<?php

use Telbots\Core\Bot;

require_once '../vendor/autoload.php';
require_once './config.php';

$bot = new Bot();
$bot->route("/start", 'HomePageController');
$bot->route("Home", 'HomePageController');
$bot->route("🤔 what's next?", 'NextStepController');
