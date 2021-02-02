<?php

namespace App\Repository;

use App\Domain\Choice;
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
        fgetcsv($fp);

        $json = [];

        while ($row = fgetcsv($fp)) {
            $question = new Question();

            $choice1 = new Choice();
            $choice1->text = $row[2];

            $choice2 = new Choice();
            $choice2->text = $row[3];

            $choice3 = new Choice();
            $choice3->text = $row[4];

            $question->text = $row[0];
            $question->createdAt = $row[1];
            $question->choices = [
                $choice1,
                $choice2,
                $choice3,
            ];

            array_push($json, $question);
        }

        fclose($fp);

        $this->questions = $json;
    }
}
