<?php

namespace TelBots\Core;

class Response
{
    public function makeMenu(int $chatId, string $text, array $keyboard = null)
    {
        if ($keyboard != null && sizeof($keyboard) > 0) {
            $resp = array("keyboard" => $keyboard, "resize_keyboard" => true, "one_time_keyboard" => false);
            $reply = json_encode($resp);
        } else if (sizeof($keyboard) == 0) {
            $keyboard = "";
            $resp = array('remove_keyboard' => true);
            $reply = json_encode($resp);
        } else {
            $reply = null;
        }
        $data = [
            'text' => $text,
            'chat_id' => $chatId,
            'reply_markup' => $reply
        ];
        file_get_contents(API_URL . "sendMessage?" . http_build_query($data));
    }

    public function makeList(int $chatId, string $text, array $keyboard = null)
    {
        $reply = json_encode($keyboard);
        $data = [
            'text' => $text,
            'chat_id' => $chatId,
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
            'reply_markup' => $reply
        ];
        file_get_contents(API_URL . "sendMessage?" . http_build_query($data));
    }

    public function sendPhoto(int $chatId, string $url, string $caption)
    {
        $resp = array('remove_keyboard' => true);
        $reply = json_encode($resp);

        $data = [
            'chat_id' => $chatId,
            'photo' => $url,
            'caption' => $caption,
            'reply_markup' => $reply,
        ];

        file_get_contents(API_URL . "sendPhoto?" . http_build_query($data));
    }
}
