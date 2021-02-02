<?php

namespace App\Repository;

use App\Domain\Question;

class JsonQuestionsRepository implements QuestionsRepository
{
    private $data_source_path = '../dataSources/questions.json';
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
        $content = file_get_contents($this->data_source_path);
        $decoded_content = json_decode($content);

        $this->questions = $decoded_content;
    }
}
