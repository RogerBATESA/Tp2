<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TabController extends AbstractController
{
    /**
     * @Route("/tab", name="tab_articles")
     */
    public function tabArticle(ArticleRepository $repo)
    {

        $articles = $repo->findAll();

        return $this->render('tab/tabArticle.html.twig',
        [
            'articles' => $articles
        ]);
    }


    /**
    * permet de créer un article
    *
    * @Route("/tab/new", name="tab_create")
    * @return Response
    */
    public function create(Request $request, ObjectManager $manager)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {


            $manager->persist($article);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>(".$article->getLibelle().")</strong> à bien été enregistrée"
            );
            return $this->redirectToRoute('tab_articles', [
                'id' => $article->getId()
            ]);

            
        }
        return $this->render('tab/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * Permet de supprimer une annonce
    *
    * @Route("/articles/{id}/delete", name="tab_delete")
    * 
    * @return Response
    */
    public function delete(Article $article, ObjectManager $manager) 
    {
        $manager->remove($article);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'article {$article->getLibelle()} a bien été supprimé"
        );

        return $this->redirectToRoute("tab_articles");
    }
}
