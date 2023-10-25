<?php

namespace App\Controller;

use App\Model\ServiceManager;

class ServiceController extends AbstractController
{
    public function index(): string
    {
        $serviceManager = new ServiceManager();
        $services = $serviceManager->selectAll();

        return $this->twig->render('Service/index.html.twig', [
            'services' => $services
        ]);
    }

    public function show(int $id): string
    {
        $serviceManager = new ServiceManager();
        $service = $serviceManager->selectOneById($id);

        return $this->twig->render('Service/show.html.twig', [
            'service' => $service
        ]);
    }
}
