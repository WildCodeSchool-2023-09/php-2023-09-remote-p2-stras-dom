<?php

namespace App\Controller;

class DevisController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Devis/index.html.twig');
    }
}
