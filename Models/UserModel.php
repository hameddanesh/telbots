<?php

namespace TelBots\Models;

use Telbots\Core\Model;

class UserModel extends Model
{
    public array $user;
    private array $database;

    public const CATEGORY_EXISTING = '[existing user]',
        CATEGORY_NEW = '[new user]';

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function fetchUser($chatId, $telUsername, $telFullname)
    {
        $this->init($this->database, "SELECT * FROM `tb.users` WHERE chatId = ?");
        if ($this->queryState === QUERY_STATE_SUCCESS) {
            $this->stmt->execute([$chatId]);
            $numRows = $this->stmt->rowCount();

            if ($numRows == 1) {
                $this->user = $this->stmt->fetchAll();
                $this->queryState = QUERY_STATE_SUCCESS;
            } else if ($numRows == 0) {
                $this->queryState = QUERY_STATE_NEW_USER;
                $this->registerUser($chatId, $telUsername, $telFullname);
            }
            return;
        }
        $this->queryState = QUERY_STATE_ERROR;
    }

    public function registerUser($chatId, $telUsername, $telFullname)
    {
        if ($this->queryState == QUERY_STATE_NEW_USER) {
            $this->init($this->database, "INSERT INTO `tb.users` (chatId, telUsername, telFullname) VALUES(?, ?, ?)");
            $this->stmt->execute([$chatId, $telUsername, $telFullname]);
        }
    }
}
