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
            if ($_POST['username'] === '') {
                $errors['username'] = 'Veuillez saisir votre username !';
            }

            if ($_POST['password'] === '') {
                $errors['password'] = 'Veuillez saisir votre password !';
            }

            if (!$errors) {
                $userManager = new UserManager();
                $user = $userManager->userLogin($_POST);
                if ($user) {
                    $_SESSION['isLogin'] = true;
                    $_SESSION['isAdmin'] = $user['isAdmin'];
                    header('Location: /');
                }
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
