<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\UserManager;

class DashboardController extends AbstractController
{
    public function index()
    {
        $userManager = new UserManager();

        return $this->twig->render('Admin/dashboard/index.html.twig', ['customers' => $userManager->numberCustomers()]);
    }
}
