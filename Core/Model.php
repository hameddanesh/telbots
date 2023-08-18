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

    public function connect($database): bool
    {
        try {
            $this->pdo = new PDO($database['dbms'] . ':host=' . $database['host'] . ';dbname=' . $database['dbname'], $database['username'], $database['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            echo '⛔ database connection failed! ⛔';
        }
        return false;
    }

    public function init($database, string $query)
    {
        if ($this->connect($database)) {
            $this->stmt = $this->pdo->prepare($query);
            $this->queryState = QUERY_STATE_SUCCESS;
            return $this->stmt;
        } else $this->queryState = QUERY_STATE_ERROR;
    }
}
