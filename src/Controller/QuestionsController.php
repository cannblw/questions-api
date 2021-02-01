<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsController extends AbstractController
{
    /**
     * @Route("/questions", methods={"GET"})
     */
    public function getQuestions(): Response
    {
        return $this->json([
            'message' => 'Get questions',
        ]);
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
