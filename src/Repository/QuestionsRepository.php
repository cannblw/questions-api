<?php

namespace App\Repository;

use App\Domain\Question;

interface QuestionsRepository
{
    public function getQuestions();
    public function addQuestion(Question $question);
    public function load();
}
