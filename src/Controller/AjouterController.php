<?php


namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjouterController extends AbstractController
{
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $article = new Article();

            $article->setTitre($request->request->get('titre'))
                ->setDescription($request->request->get('description'))
                ->setCouleurs($request->request->get('couleurs'))
                ->setPrix(floatval($request->request->get('prix')))
                ->setImageUrl($request->request->get('imageUrl'));

            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('ajouter/index.html.twig');
    }
}