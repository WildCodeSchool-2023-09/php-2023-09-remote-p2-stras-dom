<?php

namespace App\Model;

use PDO;
use App\Model\AbstractManager;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectOneByEmail(string $email)
    {
        $query = "SELECT * FROM " . self::TABLE . " WHERE email=:email";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $email);
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
