<?php

namespace telbots\Controllers;

use Telbots\Core\Bot;
use Telbots\Core\Controller;

class NextStepController extends Controller
{
    public function __construct(Bot $bot)
    {
        // this is an example
        $bot->response->makeMenu(
            $bot->request->fromId,
            "\n\n📚please follow examples or read the documentation to get started\n\n\n\nand\n\nwelcome to community ;)",
            NO_KEYBOARD
        );
        // this is an example
    }
}
