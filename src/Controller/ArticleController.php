<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleFormType;
use App\Form\CommentFormType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Utils\AppUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $entityManager;
    private $articleRepository;
    private $commentRepository;
    private $categoryRepository;

    public function __construct(ArticleRepository $articleRepository, CommentRepository $commentRepository, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->categoryRepository = $categoryRepository;
        $this->articleRepository = $articleRepository;
        $this->commentRepository = $commentRepository;
    }

    #[Route('/article/show/{id}', name: 'show_article')]
    public function show($id, Request $request): Response
    {
        $article = $this->articleRepository->find($id);
        $comment = new Comment();
        $comment->setArticle($article);

        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newComment = $form->getData();
            $newComment->setCreationDate(AppUtils::getCurrentDate('d.m.Y H:i'));
            $newComment->setArticle($article);
            $newComment->setUsername($this->getCurrentUser()->getUsername());

            $this->entityManager->persist($newComment);
            $this->entityManager->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $this->commentRepository->findCommentsByArticleId($id),
            'comment_form' => $form->createView(),
            'categories' => $this->categoryRepository->findAll()
        ]);
    }

    #[Route('/article/create', name: 'create_article')]
    public function create(Request $request): Response 
    {
        $article = new Article();

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newArticle = $form->getData();
            $newArticle->setCreationDate(AppUtils::getCurrentDate('d.m.Y'));
            $newArticle->setUsername($this->getCurrentUser()->getUsername());

            $imageSrc = $form->get('imageSrc')->getData();
            if ($imageSrc) {
                $newFileName = uniqid() . '.' . $imageSrc->guessExtension();

                try {
                    $imageSrc->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $newArticle->setImageSrc('/uploads/' . $newFileName);
            }

            $this->entityManager->persist($newArticle);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('article/create.html.twig', [
            'article_form' => $form->createView(),
            'categories' => $this->categoryRepository->findAll()
        ]);
    }

    #[Route('/article/edit/{id}', name: 'edit_article')]
    public function edit($id, Request $request): Response 
    {
        $article = $this->articleRepository->find($id);

        $this->preventRedirection($article);

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        $imageSrc = $form->get('imageSrc')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($imageSrc) {
                if ($article->getImageSrc() !== null) {
                    if (file_exists($this->getParameter('kernel.project_dir') . $article->getImageSrc())) {
                        $this->getParameter('kernel.project_dir') . $article->getImageSrc();
                    }

                    $newFileName = uniqid() . '.' . $imageSrc->guessExtension();

                    try {
                        $imageSrc->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',
                            $newFileName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }
        
                    $article->setImageSrc('/uploads/' . $newFileName);

                    $this->entityManager->flush();
                    return $this->redirectToRoute('homepage');
                }
            } else {
                $article->setTitle($form->get('title')->getData());
                $article->setDescription($form->get('description')->getData());
                $article->setContent($form->get('content')->getData());
                $article->setDuration($form->get('duration')->getData());
                $article->setIsCommentable($form->get('isCommentable')->getData());

                $this->entityManager->flush();
                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'article_form' => $form->createView(),
            'categories' => $this->categoryRepository->findAll()
        ]);
    }

    #[Route('/article/delete/{id}', name: 'delete_article', methods: ['GET', 'DELETE'])]
    public function delete($id): Response 
    {
        $article = $this->articleRepository->find($id);

        $this->preventRedirection($article);

        $this->entityManager->remove($article);
        $this->entityManager->flush();
        return $this->redirectToRoute('homepage');
    }

    private function getCurrentUser() 
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->getUser();
    }

    private function preventRedirection(Article $article) {
        if ($this->getCurrentUser()->getUsername() !== $article->getUsername()) {
            throw new AccessDeniedHttpException('Access denied');
        }
    }
}
