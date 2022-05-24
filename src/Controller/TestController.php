<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    #[Route('/create', name: 'create_article')]
    public function create(): Response 
    {
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);

        return $this->render('article/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
