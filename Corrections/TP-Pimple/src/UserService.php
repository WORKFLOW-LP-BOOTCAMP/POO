<?php namespace Pimple;

class UserService
{
    private NotificationService $emailService;
    private NotificationService $smsService;

    public function __construct(NotificationService $emailService, NotificationService $smsService)
    {
        $this->emailService = $emailService;
        $this->smsService = $smsService;
    }

    public function notifyUser(User $user, $message):string
    {
        $email = $this->emailService->send($user->getEmail(), $message);
        $phone = $this->smsService->send($user->getPhone(), $message);

        return "$email\n$phone";
    }
}