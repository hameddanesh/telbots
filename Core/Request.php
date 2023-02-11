<?php

namespace Telbots\Core;

class Request
{
    private $requestObject;
    public string $type;
    public $message;
    public $data = null;
    public int $messageId = 0;
    public string $text = "";
    public string $date = "";

    public int $fromId = 0;
    public bool $fromIsBot = false;
    public string $fromFirstName = "";
    public string $fromLastName = "";
    public string $fromFullName = "";
    public string $fromUsername = "";
    public string $fromLanguage = "en";

    public int $chatId = 0;
    public string $chatFirstName = "";
    public string $chatLastName = "";
    public string $chatFullName = "";
    public string $chatUsername = "";


    public function __construct()
    {
        $rawRequest = file_get_contents('php://input');
        $this->requestObject = json_decode($rawRequest, true);
        // if (!$this->requestObject) exit;
        if ($this->requestObject) $this->extract();
    }

    private function extract()
    {
        $this->messageAndDataExtractor();
        $this->messageId = $this->message["message_id"];
        $this->date = $this->message["date"];
        $this->text = $this->message["text"];
        $this->fromExtractor();
        $this->chatExtractor();
    }

    private function messageAndDataExtractor()
    {
        if (isset($this->requestObject["callback_query"]["data"])) {
            $this->type = 'CALLBACK';
            $this->message = $this->requestObject["callback_query"]["message"];
            $this->data = (string)$this->requestObject["callback_query"]["data"];
        } else if (isset($this->requestObject["message"])) {
            $this->type = 'MESSAGE';
            $this->message = $this->requestObject["message"];
        }
    }

    private function fromExtractor()
    {
        $this->fromId = $this->message["from"]["id"];
        $this->fromIsBot = ($this->message["from"]["is_bot"] == "true");
        $this->fromFirstName = $this->message["from"]["first_name"];
        $this->fromLastName = $this->message["from"]["last_name"];
        $this->fromFullName = $this->fromFirstName . " " . $this->fromLastName;
        $this->fromUsername = $this->message["from"]["username"];
        $this->fromLanguage = $this->message["from"]["language_code"];
    }

    private function chatExtractor()
    {
        $this->chatId = $this->message["chat"]["id"];
        $this->chatFirstName = $this->message["chat"]["first_name"];
        $this->chatLastName = $this->message["chat"]["last_name"];
        $this->chatFullName = $this->chatFirstName . " " . $this->chatLastName;
        $this->chatUsername = $this->message["chat"]["username"];
    }
}
