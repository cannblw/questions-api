<?php

namespace App\Repository;

use App\Domain\Question;

class CsvQuestionsRepository implements QuestionsRepository
{
    private $data_source_path = '../database/questions.csv';
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
        $fp = fopen($this->data_source_path, 'r');

        // Ignore column titles
        fgetcsv($fp, '1024', ',');

        $json = [];

        while ($row = fgetcsv($fp, '1024', ',')) {
            $question = new Question();

            $question->text = $row[0];
            $question->createdAt = $row[1];
            $question->choices = [
                ['text' => $row[2]],
                ['text' => $row[3]],
                ['text' => $row[4]],
            ];

            array_push($json, $question);
        }

        fclose($fp);

        $this->questions = $json;
    }
}
