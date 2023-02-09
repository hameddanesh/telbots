<?php

namespace TelBots\Core;

use TelBots\Models\UserModel;

class Bot
{
    public Request $request;
    public Response $response;
    public array $user = [];
    public string $userCategory = UserModel::CATEGORY_NEW;

    private UserModel $userModel;
    private string $controllersFolder = '\\TelBots\\Controllers\\';

    public function __construct()
    {
        new Constant();
        $this->request = new Request();
        $this->response = new Response();
        $this->userModel = new UserModel();
        $this->userModel->fetchUser($this->request->fromId, $this->request->fromUsername, $this->request->fromFirstName . ' ' . $this->request->fromLastName);
        if ($this->userModel->queryState === QUERY_STATE_SUCCESS) {
            $this->user = $this->userModel->user;
            $this->userCategory = UserModel::CATEGORY_EXISTING;
        }
    }

    public function route(string $botInput, string $controllerName, ...$controllerArgs)
    {
        if ($this->request->text == $botInput) {
            $controllerName = $this->controllersFolder . $controllerName;
            new $controllerName($this, ...$controllerArgs);
        }
    }
}
