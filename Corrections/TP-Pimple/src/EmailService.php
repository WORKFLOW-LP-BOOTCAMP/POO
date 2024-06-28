<?php namespace Pimple;

class EmailService implements NotificationService
{
    public function send($to, $message):string
    {
        return "Sending Email to $to: $message\n";
    }
}