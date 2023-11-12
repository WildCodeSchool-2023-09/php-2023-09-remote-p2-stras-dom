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

    public function insert(array $user)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`firstname`, `lastname`, `email`, `password`, `adresse`) 
        VALUES (:firstname, :lastname, :email, :password, :adresse)");
        $statement->bindValue('firstname', $user['firstname'], PDO::PARAM_STR);
        $statement->bindValue('lastname', $user['lastname'], PDO::PARAM_STR);
        $statement->bindValue('email', $user['email'], PDO::PARAM_STR);
        $statement->bindValue('password', password_hash($user['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $statement->bindValue('adresse', $user['adresse'], PDO::PARAM_STR);
        $statement->execute();
    }
}
