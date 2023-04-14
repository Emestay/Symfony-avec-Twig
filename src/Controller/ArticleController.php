<?php

namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    private ArticleRepository $repoArticle;

    public function __construct(ArticleRepository $repoArticle)
    {
        $this->repoArticle = $repoArticle;
    }

    public function show(int $id): Response
    {
        $article = $this->repoArticle->find($id);


        $user = $article->getUser();

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'user' => $user,
        ]);
    }


    public function index(ArticleRepository $repoArticle): Response
    {
        $articles = $repoArticle->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
