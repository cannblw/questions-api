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
        $dateTimeFormat = $_ENV['DATE_TIME_FORMAT'];

        $question->text = $body->text;
        $question->createdAt = date($dateTimeFormat);
        $question->choices = $body->choices;

        return $question;
    }
}
