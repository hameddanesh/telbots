<?php

namespace Telbots\Core;

use PDO;
use PDOException;

class Model
{
    private $pdo = null;
    public $stmt = null;
    public array $errors = [];
    public string $queryState;

    private function connect(): bool
    {
        try {
            $this->pdo = new PDO(DATABASE['dbms'] . ':host=' . DATABASE['host'] . ';dbname=' . DATABASE['dbname'], DATABASE['username'], DATABASE['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return false;
    }

    public function init(string $query)
    {
        if ($this->connect()) {
            $this->stmt = $this->pdo->prepare($query);
            $this->queryState = QUERY_STATE_SUCCESS;
            return $this->stmt;
        } else {
            $this->queryState = QUERY_STATE_ERROR;
        }
    }
}
