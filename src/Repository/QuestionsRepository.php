<?php

namespace App\Repository;

use App\Domain\Question;

interface QuestionsRepository
{
    public function getQuestions(): array;
    public function addQuestion(Question $question): void;
    public function load(): void;
}
