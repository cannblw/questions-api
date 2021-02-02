<?php

namespace App\Service;

use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleTranslationService implements TranslationService
{
    private $translator;

    public function __construct()
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
                $choice->text = $this->translator->translate($choice->text);
            }
        }

        return $questions;
    }
}
