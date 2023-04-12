<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class AjouterController extends AbstractController
{
    
    public function index(): Response
    {
        return $this->render('ajouter/index.html.twig');
    }
}