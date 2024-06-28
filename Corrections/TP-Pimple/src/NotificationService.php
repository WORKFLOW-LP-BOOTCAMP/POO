<?php namespace Pimple;

interface NotificationService
{
    public function send($to, $message):string;
}