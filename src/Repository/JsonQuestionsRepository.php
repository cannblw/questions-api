<?php

namespace App\Repository;

use App\Domain\Question;

const DATA_SOURCE_PATH = '../dataSources/questions.json';

class JsonQuestionsRepository implements QuestionsRepository
{
    private $questions = [];

    public function __construct()
    {
        $this->load();
    }

    public function getQuestions()
    {
        return $this->questions;
    }

    public function addQuestion(Question $question)
    {
        array_push($this->questions, $question);
    }

    private function load()
    {
        $content = file_get_contents(DATA_SOURCE_PATH);
        $decoded_content = json_decode($content);

        $this->questions = $decoded_content;
    }
}
