<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class ArticleController extends AbstractController
{
    public function show(int $id): Response
    {
        $articles = $this->getArticles();


        if ($id < 0 || $id >= count($articles)) {
            throw $this->createNotFoundException('Article ya pas.');
        }

        $article = $articles[$id];

        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }

    public function index(): Response
    {
        $articles = $this->getArticles();

        return $this->render('article/index.html.twig', [
            'articles' => $articles
        ]);

    }

    /**
     * @return \string[][]
     */
    public function getArticles(): array
    {
        $articles = [
            [
                'titre' => 'Pack de 8 T-shirts Basiques',
                'description' => 'Obtenez la gamme complète de nos T-shirts basiques. Ayez un nouveau t-shirt toute la semaine et un supplémentaire pour le jour de lessive.',
                'couleurs' => '8 couleurs',
                'prix' => '230€',
                'imageUrl' => 'https://tailwindui.com/img/ecommerce-images/category-page-02-image-card-01.jpg'
            ],
            [
                'titre' => 'T-shirt Basique',
                'description' => 'Ayez l\'air d\'un PDG visionnaire et portez le même t-shirt noir tous les jours.',
                'couleurs' => 'Noir',
                'prix' => '29€',
                'imageUrl' => 'https://tailwindui.com/img/ecommerce-images/category-page-02-image-card-02.jpg'
            ],
            [
                'titre' => 'T-shirt à Manches Longues',
                'description' => 'Restez au chaud et à l\'aise avec notre t-shirt à manches longues de qualité supérieure.',
                'couleurs' => '5 couleurs',
                'prix' => '35€',
                'imageUrl' => 'https://tailwindui.com/img/ecommerce-images/category-page-02-image-card-03.jpg'
            ],
            [
                'titre' => 'T-shirt Col V',
                'description' => 'Affichez un style décontracté avec notre t-shirt col V confortable et élégant.',
                'couleurs' => '6 couleurs',
                'prix' => '25€',
                'imageUrl' => 'https://tailwindui.com/img/ecommerce-images/category-page-02-image-card-04.jpg'
            ],
            [
                'titre' => 'T-shirt Graphique',
                'description' => 'Exprimez-vous avec notre t-shirt graphique au design unique et accrocheur.',
                'couleurs' => '4 couleurs',
                'prix' => '28€',
                'imageUrl' => 'https://tailwindui.com/img/ecommerce-images/category-page-02-image-card-05.jpg'
            ]
        ];
        return $articles;
    }
}
