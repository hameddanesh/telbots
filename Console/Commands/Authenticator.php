<?php

namespace Telbots\Console\Commands;

use Telbots\Core\Model;

class Authenticator
{
    private $database;
    private Model $model;

    public function __construct($database, $model)
    {
        $this->database = $database;
        $this->model =  new Model();
    }

    public function checkRootExists()
    {
        $query = "SELECT COUNT(panelUsername) as 'exists' FROM `tb.users` where panelUsername ='root'";
        $this->model->init($this->database, $query);
        $this->model->stmt->execute();
        $root = $this->model->stmt->fetchAll();
        if ($root[0]['exists'] == 1) {
            return true;
        }
        return false;
    }

    public function createRoot(string $password)
    {
        $this->model->init($this->database, "INSERT IGNORE INTO `tb.users` VALUES (1,'root','root','root','root',?,'home',0,0,0,0,NULL);");
        $this->model->stmt->execute([md5($password)]);
        echo "root user created, please log in to continue.\n\n";
    }

    public function login(string $username, string $password)
    {
        $this->model->init($this->database, "SELECT `chatId`, `panelUsername`, `panelPassword` FROM `tb.users` WHERE `panelUsername` = ?");
        $this->model->stmt->execute([$username]);

        $numRows = $this->model->stmt->rowCount();
        if ($numRows === 1) {
            $user = $this->model->stmt->fetchAll();
            if ($user[0]['panelPassword'] === md5($password)) {
                $_SESSION['valid_user'] = true;
                $_SESSION['chat_id'] = $user[0]['chatId'];
                $_SESSION['username'] = $user[0]['panelUsername'];
                return;
            }
        }
        echo "invalid username/password, please try again.\n";
        $_SESSION['valid_user'] = false;
    }
}
