<?php

namespace App\Controller;

use App\Model\ReservationManager;
use App\Model\ServiceManager;

class ReservationController extends AbstractController
{
    public function insert(): string
    {
        $serviceManager = new ServiceManager();
        $services = $serviceManager->selectAll();

        $reservationManager = new ReservationManager();
        $dates = $reservationManager->selectDisponible();

        if (!empty($_POST['services'])) {
            $userId = $_SESSION['user_id'];
            $date = $_POST['date'];
            $services = array_filter($_POST['services'], function ($value) {
                return is_string($value);
            });
            $reservationManager->insert($date, $services, $userId);
            header('Location: /');
        }
        return $this->twig->render('Reservation/reservation.html.twig', [
            'services' => $services,
            'dates' => $dates
        ]);
    }

    public function index(): string
    {

        $reservationManager = new ReservationManager();
        $reservations = $reservationManager->selectAllReservations();

        return $this->twig->render('Admin/Reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
