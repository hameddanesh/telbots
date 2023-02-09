<?php

namespace TelBots\Models;

use TelBots\Core\Model;

class UserModel extends Model
{
    public array $user;

    public const CATEGORY_EXISTING = '[existing user]',
        CATEGORY_NEW = '[new user]';

    public function fetchUser($chatId, $telUsername, $telFullname)
    {
        $this->init("SELECT * FROM `tb.users` WHERE chatId = ?");
        $this->stmt->execute([$chatId]);
        $numRows = $this->stmt->rowCount();

        if ($numRows == 1) {
            $this->user = $this->stmt->fetchAll();
            $this->queryState = QUERY_STATE_SUCCESS;
        } else if ($numRows == 0) {
            $this->queryState = QUERY_STATE_NEW_USER;
            $this->registerUser($chatId, $telUsername, $telFullname);
        } else {
            $this->queryState = QUERY_STATE_ERROR;
        }
    }

    public function registerUser($chatId, $telUsername, $telFullname)
    {
        if ($this->queryState == QUERY_STATE_NEW_USER) {
            $this->init("INSERT INTO `tb.users` (chatId, telUsername, telFullname) VALUES(?, ?, ?)");
            $this->stmt->execute([$chatId, $telUsername, $telFullname]);
        }
    }
}
