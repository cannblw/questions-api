<?php

namespace App\Controller;

use App\Domain\Question;
use App\Repository\QuestionsRepository;
use App\Service\TranslationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

const ERRORS = [
    'WRONG_LANG_FORMAT' => 'Wrong lang format. It should be ISO 639-1',
    'NO_TEXT' => 'Field text is required',
    'WRONG_CHOICES' => 'Insert 3 choices',
];

class QuestionsController extends AbstractController
{
    /**
     * @Route("/questions", methods={"GET"})
     */
    public function getQuestions(
        QuestionsRepository $repository,
        TranslationService $translationService,
        Request $request
    ): Response {
        $params = $request->query->all();

        if (!isset($params['lang']) || !is_string($params['lang']) || strlen($params['lang']) != 2) {
            return $this->json(ERRORS['WRONG_LANG_FORMAT'], Response::HTTP_BAD_REQUEST);
        }

        $lang = $params['lang'];

        $questions = $repository->getQuestions();
        $translatedQuestions = $translationService->translateQuestions($questions, $lang);

        return $this->json($translatedQuestions);
    }

    /**
     * @Route("/questions", methods={"POST"})
     */
    public function createQuestion(QuestionsRepository $repository, Request $request): Response
    {
        $body = json_decode($request->getContent());

        if (!isset($body->text) || !is_string($body->text) || strlen($body->text) == 0) {
            return $this->json(ERRORS['NO_TEXT'], Response::HTTP_BAD_REQUEST);
        }

        if (!isset($body->choices) || !is_array($body->choices) || count($body->choices) != 3) {
            return $this->json(ERRORS['WRONG_CHOICES'], Response::HTTP_BAD_REQUEST);
        }

        $question = Question::fromRequestBody($body);

        $repository->addQuestion($question);
        $questions = $repository->getQuestions();

        return $this->json($questions);
    }
}
