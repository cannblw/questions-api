<?php

namespace App\Repository;

use App\Domain\Question;

class JsonQuestionsRepository implements QuestionsRepository
{
    private $data_source_path = '../database/questions.json';

    public function getQuestions()
    {
        $content = file_get_contents($this->data_source_path);

        return json_decode($content);
    }

    public function addQuestion(Question $question)
    {
        $content = file_get_contents($this->data_source_path);
        $questions = json_decode($content);

        array_push($questions, $question);

        $updatedQuestions = json_encode($questions);

        file_put_contents($this->data_source_path, $updatedQuestions);
    }
}
