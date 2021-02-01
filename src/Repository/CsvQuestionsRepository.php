<?php

namespace App\Repository;

use App\Domain\Question;

const DATA_SOURCE_PATH = '../dataSources/questions.csv';

class CsvQuestionsRepository implements QuestionsRepository
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
        $fp = fopen(DATA_SOURCE_PATH, 'r');

        // Ignore column titles
        fgetcsv($fp, '1024', ',');

        $json = [];

        while ($row = fgetcsv($fp, '1024', ',')) {
            $question = new Question();

            $question->text = $row[0];
            $question->createdAt = $row[1];
            $question->choices = [
                $row[2],
                $row[3],
                $row[4],
            ];

            array_push($json, $question);
        }

        fclose($fp);

        $this->questions = $json;
    }
}
