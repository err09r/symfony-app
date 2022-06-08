<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $articleRepository;
    private $categoryRepository;
    private $commentRepository;

    public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, CommentRepository $commentRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->commentRepository = $commentRepository;
    }

    #[Route('/', name: 'homepage', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $this->articleRepository->findAllByDateDescending(),
            'categories' =>$this->categoryRepository->findAll(),
            'comments' => $this->commentRepository->findAll()
        ]);
    }

    #[Route('/profile', name: 'profile', methods: ['GET'])]
    public function profile(): Response
    {
        return $this->render('profile/profile.html.twig', [
            'user' => $this->getUser(),
            'categories' => $this->categoryRepository->findAll()
        ]);
    }
}