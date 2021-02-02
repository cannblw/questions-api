<?php

namespace App\Service;

interface TranslationService
{
    public function translateQuestions(array $questions, string $targetLanguage);
}
