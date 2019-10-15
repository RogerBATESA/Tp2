<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
    * @Route("/articles", name="articles_liste")
    */
    public function listArticles(ArticleRepository $repo)
    {
        return $this->render('article/index.html.twig',
        [
            'articles' => $repo->findAll()
        ]);
    }

    /**
    * @Route("/article/{id}", name="article_fiche")
    */
    public function afficheArticle(Article $article)
    {
        return $this->render('article/afficheArticle.html.twig',
        [
            'article' => $article
        ]);
    }
}
