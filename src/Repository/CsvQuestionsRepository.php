<?php

namespace App\Repository;

use App\Domain\Question;

const DATA_SOURCE_PATH = '../dataSources/questions.csv';

class CsvQuestionsRepository implements QuestionsRepository
{
    private $questions = [];

    public function getQuestions()
    {
        return $this->questions;
    }

    public function addQuestion(Question $question)
    {
        array_push($this->questions, $question);
    }

    public function load()
    {
        $fp = fopen(DATA_SOURCE_PATH, 'r');

        $key = fgetcsv($fp, "1024", ",");

        $json = array();

        while ($row = fgetcsv($fp, "1024", ",")) {
            $json[] = array_combine($key, $row);
        }

        fclose($fp);

        var_dump($json);

        $this->questions = json_encode($json);
    }
}
