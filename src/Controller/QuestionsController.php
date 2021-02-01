<?php

namespace App\Controller;

use App\Repository\QuestionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsController extends AbstractController
{
    public function __construct(QuestionsRepository $repository)
    {
        $repository->load();
    }

    /**
     * @Route("/questions", methods={"GET"})
     */
    public function getQuestions(QuestionsRepository $repository): Response
    {
        return $this->json($repository->getQuestions());
    }

    /**
     * @Route("/questions", methods={"POST"})
     */
    public function createQuestion(): Response
    {
        return $this->json([
            'message' => 'Create question',
        ]);
    }
}
