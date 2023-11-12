<?php

namespace App\Model;

use App\Model\AbstractManager;
use DateTime;

class ReservationManager extends AbstractManager
{
    public const TABLE = 'reservation';

    public function selectDisponible(): array
    {
        $query = "SELECT date FROM " . static::TABLE . " WHERE is_disponible = 1";

        return $this->pdo->query($query)->fetchAll();
    }

    public function insert($date, $services, $userId): int
    {
        $dateTime = new DateTime($date);
        $query = "INSERT INTO " . static::TABLE . " (date, service_id, user_id, is_disponible) VALUES 
        (:date, :service_id, :user_id, 0)";
        $statement = $this->pdo->prepare($query);

        foreach ($services as $serviceId) {
            $statement->execute([
                'date' => $dateTime->format('Y-m-d H:i:s'),
                'service_id' => $serviceId,
                'user_id' => $userId,
            ]);
        }
        return (int)$this->pdo->lastInsertId();
    }

    public function selectAllReservations(): array
    {
        $query = "SELECT reservation.*, service.name AS service_name, user.firstname, user.lastname
        FROM " . static::TABLE .
            " JOIN service ON reservation.service_id = service.id
        JOIN user ON reservation.user_id = user.id";

        return $this->pdo->query($query)->fetchAll();
    }
}
