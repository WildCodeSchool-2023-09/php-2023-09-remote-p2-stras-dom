<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function register(): string
    {
        $errors = [];
        if (!empty($_POST)) {
            $userForm = array_map('trim', $_POST);

            $requireds = ['firstname', 'lastname', 'email', 'password', 'adresse'];

            foreach ($requireds as $required) {
                if (!isset($userForm[$required]) || empty($userForm[$required])) {
                    $errors[$required] = 'Le champ est obligatoire';
                }
            }
            if (!filter_var($userForm['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'L\'email n\'est pas valide';
            }

            if (empty($errors)) {
                $userManager = new UserManager();
                $userManager->insert($userForm);
                header('Location: /');
            }
        }
        return $this->twig->render('User/register.html.twig', [
            'errors' => $errors
        ]);
    }
}
