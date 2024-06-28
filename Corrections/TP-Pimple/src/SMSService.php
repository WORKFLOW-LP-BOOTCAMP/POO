<?php namespace Pimple;
class SMSService implements NotificationService
{
    public function send($to, $message) : string
    {
        return "Sending SMS to $to: $message\n";
    }
}