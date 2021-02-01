<?php

namespace App\Controller;

use App\Domain\Question;
use App\Repository\QuestionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function createQuestion(QuestionsRepository $repository, Request $request): Response
    {
        $body = json_decode($request->getContent());
        $question = Question::fromRequestBody($body);

        $repository->addQuestion($question);
        $questions = $repository->getQuestions();

        return $this->json($questions);
    }
}
