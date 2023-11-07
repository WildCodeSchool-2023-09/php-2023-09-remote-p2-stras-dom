<?php

namespace App\Model;

use PDO;
use App\Model\AbstractManager;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function userLogin(array $username)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " 
        WHERE username=:username AND password=:password");
        $statement->bindValue('username', $username['username'], \PDO::PARAM_STR);
        $statement->bindValue('password', $username['password'], \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function numberCustomers()
    {
        // prepared request
        $statement = $this->pdo->query("SELECT * FROM " . static::TABLE . " WHERE isAdmin=false");
        return $statement->fetchAll();
    }
}
