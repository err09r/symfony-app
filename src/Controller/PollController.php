<?php

namespace App\Controller;

use App\Entity\Poll;
use App\Entity\PollOption;
use App\Form\PollFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PollController extends AbstractController
{
    private $entityManager;
    private $categoryRepository;

    public function __construct(EntityManagerInterface $entityManager, CategoryRepository $categoryRepository)
    {
        $this->entityManager = $entityManager;
        $this->categoryRepository = $categoryRepository;
    }

    #[Route('/poll/create/{id}', name: 'create_poll')]
    public function create(Request $request, $id): Response
    {
        $poll = new Poll();

        $form = $this->createForm(PollFormType::class, $poll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPoll = $form->getData();
            $pollOption1 = new PollOption();
            $pollOption1->setValue(0);
            $pollOption1->setPoll($newPoll);
            $pollOption1->setTitle($form['option1_title']->getData());

            $pollOption2 = new PollOption();
            $pollOption2->setValue(0);
            $pollOption2->setPoll($newPoll);
            $pollOption2->setTitle($form['option2_title']->getData());


            $pollOption3 = new PollOption();
            $pollOption3->setValue(0);
            $pollOption3->setPoll($newPoll);
            $pollOption3->setTitle($form['option3_title']->getData());


            $pollOption4 = new PollOption();
            $pollOption4->setValue(0);
            $pollOption4->setPoll($newPoll);
            $pollOption4->setTitle($form['option4_title']->getData());

            $this->entityManager->persist($pollOption1);
            $this->entityManager->persist($pollOption2);
            $this->entityManager->persist($pollOption3);
            $this->entityManager->persist($pollOption4);
            $this->entityManager->persist($newPoll);
            $this->entityManager->flush();

            return $this->redirect('/article/show' . $id);
        }

        return $this->render('poll/create.html.twig', [
            'poll_form' => $form->createView(),
            'categories' => $this->categoryRepository->findAll()
        ]);
    }
}
