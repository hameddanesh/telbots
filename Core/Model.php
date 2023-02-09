<?php

namespace TelBots\Core;

use PDO;
use PDOException;

class Model
{
    private $pdo = null;
    public $stmt = null;
    public array $errors = [];
    public string $queryState;

    private function connect()
    {
        try {
            $this->pdo = new PDO(DATABASE['dbms'] . ':host=' . DATABASE['host'] . ';dbname=' . DATABASE['dbname'], DATABASE['username'], DATABASE['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function init(string $query)
    {
        $this->connect();
        $this->stmt = $this->pdo->prepare($query);
        return $this->stmt;
    }
}
