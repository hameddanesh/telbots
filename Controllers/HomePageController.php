<?php
// this is an example

namespace TelBots\Controllers;

use TelBots\Core\Bot;
use TelBots\Core\Controller;
use TelBots\Models\UserModel;

class HomePageController extends Controller
{
    public function __construct(Bot $bot)
    {
        $bot->response->makeMenu($bot->request->fromId, "👋 hello dear " . $bot->request->fromFullName . ".\n🤖 your bot is online.\n\n", null);

        $keyboard = array(array("🤔 what's next?"));


        if ($bot->userCategory === UserModel::CATEGORY_NEW) {
            $bot->response->makeMenu($bot->request->fromId, "🗃 your user is registered to bot and added to database", $keyboard);
        } else {
            $bot->response->makeMenu($bot->request->fromId, "🗃 your user already exists", $keyboard);
        }
    }
}
