<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $articleRepository;
    private $commentRepository;

    public function __construct(ArticleRepository $articleRepository, CommentRepository $commentRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->commentRepository = $commentRepository;
    }

    #[Route('/article/{id}', name: 'show_article')]
    public function show($id): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);

        return $this->render('article/show.html.twig', [
            'article' => $this->articleRepository->find($id),
            'comments' => $this->commentRepository->findAll(),
            'form' => $form->createView()
        ]);
    }
}
