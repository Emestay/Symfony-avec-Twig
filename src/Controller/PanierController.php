<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\PanierItem;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier_index')]
    public function index(PanierRepository $repoPanier): Response
    {
        $user = $this->getUser();
        $panier = $repoPanier->findOneBy(['user' => $user]);

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    #[Route('/panier/add/{id}', name: 'panier_add')]
    public function addToCart(Article $article, PanierRepository $panierRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'You must be logged in to add items to the cart.');
            return $this->redirectToRoute('article_index');
        }

        $panier = $panierRepository->findOneBy(['user' => $user]);

        if (!$panier) {
            $panier = new Panier();
            $panier->setUser($user);
        }

        $panierItem = new PanierItem();
        $panierItem->setArticle($article);
        $panierItem->setQuantity(1); //  quantity.
        $panier->addItem($panierItem);

        // Panier and PanierItem to the db
        $entityManager->persist($panier);
        $entityManager->flush();

        $this->addFlash('success', 'Article added to cart');

        return $this->redirectToRoute('article_index');
    }
}
