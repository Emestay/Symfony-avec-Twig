<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{


    public function index(): Response
    {
        // test
        $items = [
            ['title' => 'Item 1', 'description' => 'Je suis le truc numéro 1.'],
            ['title' => 'Item 2', 'description' => 'Moi je suis le 2 voila.'],
            ['title' => 'Item 3', 'description' => 'Moi je suis le 3 voila.'],
            // etc
        ];

        $message = $this->getWelcomeMessage();

        return $this->render('home/index.html.twig', [
            'items' => $items,
            'welcome_message' => $message,
        ]);
    }
    private function getWelcomeMessage(): string
    {
        $hour = (int) date('G');

        if ($hour >= 5 && $hour < 12) {
            return 'Bonjour!';
        } elseif ($hour >= 12 && $hour < 18) {
            return 'Bon aprem!';
        } elseif ($hour >= 18 && $hour < 23) {
            return 'Bon apéro!';
        } else {
            return 'Bonne nuit!';
        }
    }
}