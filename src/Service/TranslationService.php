<?php

namespace App\Service;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    private $translator;

    private function __construct()
    {
        $this->translator = new GoogleTranslate();
        $this->translator->setSource('en');
    }

    public function translateQuestions($questions, $targetLanguage)
    {
        $this->translator->setTarget($targetLanguage);

        foreach ($questions as $question) {
            $question->text = $this->translator->translate($question->text);

            foreach ($question->choices as $choice) {
                $choice = $this->translator->translate($choice);
            }
        }

        return $questions;
    }
}
