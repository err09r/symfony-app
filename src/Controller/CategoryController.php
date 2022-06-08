<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private $entityManager;
    private $categoryRepository;
    private $articleRepository;
    private $commentRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository,
        ArticleRepository $articleRepository,
        CommentRepository $commentRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->categoryRepository = $categoryRepository;
        $this->commentRepository = $commentRepository;
        $this->articleRepository = $articleRepository;
    }

    #[Route('/category/create', name: 'create_category')]
    public function create(Request $request): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newCategory = $form->getData();

            $this->entityManager->persist($newCategory);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('category/create.html.twig', [
            'category_form' => $form->createView(),
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }

    #[Route('/category/{title}', name: 'show_category')]
    public function show($title): Response
    {
        $category = $this->categoryRepository->findBy(['title' => $title])[0];
        $articles = $this->articleRepository->findBy(['category' => $category]);

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'categories' =>$this->categoryRepository->findAll(),
            'comments' => $this->commentRepository->findAll()
        ]);
    }
}
