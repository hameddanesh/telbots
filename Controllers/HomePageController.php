<?php

namespace Telbots\Controllers;

use Telbots\Core\Bot;
use Telbots\Core\Controller;
use Telbots\Models\UserModel;

class HomePageController extends Controller
{
    public function __construct(Bot $bot)
    {
        // this is an example
        $bot->response->makeMenu($bot->request->fromId, "š hello dear " . $bot->request->fromFullName . ".\nš¤ your bot is online.\n\n", null);

        $keyboard = array(array("š¤ what's next?"));

        if ($bot->userCategory === UserModel::CATEGORY_NEW) {
            $bot->response->makeMenu($bot->request->fromId, "š your user is registered to bot and added to database", $keyboard);
        } else {
            $bot->response->makeMenu($bot->request->fromId, "š your user already exists", $keyboard);
        }
        // this is an example
    }
}
