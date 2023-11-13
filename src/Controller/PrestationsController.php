<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\ServiceManager;

class PrestationsController extends AbstractController
{
    /**
     * Listing service
     */
    public function index()
    {
        $serviceManager = new ServiceManager();
        $allServices = $serviceManager->selectAll();
        return $this->twig->render(
            'Admin/Prestations/index.html.twig',
            ['services' => $allServices]
        );
    }

    /**
     * add new service
     */
    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }
            $fileName = '';
            foreach ($_FILES['image']['tmp_name'] as $index => $tmpName) {
                $fileName = $_FILES['image']['name'][$index];
                move_uploaded_file($tmpName, $uploadDir . $fileName);
            }
            $serviceManager = new ServiceManager();
            $serviceManager->insert($_POST, $fileName);
            header('Location: /admin/prestations');
        }

        return $this->twig->render('Admin/Prestations/new.html.twig');
    }

    /**
     * edit new service
     */
    public function edit(int $id)
    {
        $serviceManager = new ServiceManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }
            $fileName = '';
            foreach ($_FILES['image']['tmp_name'] as $index => $tmpName) {
                $fileName = $_FILES['image']['name'][$index];
                move_uploaded_file($tmpName, $uploadDir . $fileName);
            }
            $serviceManager->update($_POST, $fileName);
            header('Location: /admin/prestations');
        }

        $service = $serviceManager->selectOneById($id);

        return $this->twig->render('Admin/Prestations/edit.html.twig', ['service' => $service]);
    }

    public function delete(int $id)
    {
        $serviceManager = new ServiceManager();
        $serviceManager->delete($id);
        header('Location: /admin/prestations');
    }
}
