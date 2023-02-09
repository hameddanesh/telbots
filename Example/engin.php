<?php

use TelBots\Core\Bot;
use TelBots\Models\UserModel;

require_once '../vendor/autoload.php';
require_once './config.php';

$bot = new Bot();
$bot->route("/start", 'HomePageController');
$bot->route("Home", 'HomePageController');
$bot->route("🤔 whats next?", 'NextStepController');
