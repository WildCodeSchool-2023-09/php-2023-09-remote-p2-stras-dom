<?php

namespace App\Model;

use App\Model\AbstractManager;

class ServiceManager extends AbstractManager
{
    public const TABLE = 'service';

    /**
     * Insert new service in database
     */
    public function insert(array $service): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (name, description, image, price) 
        VALUES (:name, :description, :image, :price)");
        $statement->bindValue('name', $service['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $service['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $service['image'], \PDO::PARAM_STR);
        $statement->bindValue('price', $service['price'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update new service in database
     */
    public function update(array $service): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET name=:name, description=:description, image=:image, price=:price WHERE id=:id");
        $statement->bindValue('name', $service['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $service['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $service['image'], \PDO::PARAM_STR);
        $statement->bindValue('price', $service['price'], \PDO::PARAM_INT);
        $statement->bindValue('id', $service['id'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
