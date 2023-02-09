<?php
// this is an example

namespace TelBots\Controllers;

use TelBots\Core\Bot;
use TelBots\Core\Controller;

class NextStepController extends Controller
{
    public function __construct(Bot $bot)
    {
        $keyboard = array(); // empty array removes keyboard
        $bot->response->makeMenu($bot->request->fromId, "\n\n📚please fallow examples or read the documentation to get started\n\n\n\nand\n\nwelcome to community ;)", $keyboard);
    }
}
