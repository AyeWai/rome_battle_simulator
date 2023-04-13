<?php
namespace App\Service;

class UserMessageGenerator
{
    public function getWelcomeMessage(): string
    {
        $message = [
            'Ave Imperator!',
            'We salute you supreme chef!',
            'Welcome, may the gods have good fortune !',
        ];

        $index = array_rand($message);

        return $message[$index];
    }
}