<?php

namespace App\Domain;

class Question
{
    public $text;
    public $createdAt;
    public $choices;

    public static function fromRequestBody($body)
    {
        $question = new Question();

        $question->text = $body->text;
        $question->createdAt = $body->createdAt;
        $question->choices = $body->choices;

        return $question;
    }
}
