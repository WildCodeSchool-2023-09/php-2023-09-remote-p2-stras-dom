<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\UserManager;

class SecurityController extends AbstractController
{
    public function login()
    {
        $errors = [];

        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {
            header('Location: /');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);

            $userManager = new UserManager();
            $user = $userManager->selectOneByEmail($credentials['email']);
            if ($user && password_verify($credentials['password'], $user['password'])) {
                $_SESSION['isLogin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['isAdmin'] = $user['isAdmin'];
                header('Location: /');
            }
        }

        return $this->twig->render('Security/login.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        unset($_SESSION['isLogin']);
        unset($_SESSION['isAdmin']);
        header('Location: /connexion');
    }
}
