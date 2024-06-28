<?php

require 'vendor/autoload.php' ;

use Pimple\{Container, EmailService, SMSService, UserService, User};

$container = new Container();

// Enregistrer les services dans le conteneur
$container->set('emailservice', function ($c) {
    return new EmailService();
});

$container->set('smsservice', function ($c) {
    return new SMSService();
});

$container->set('userservice', function ($c) {
    return new UserService(
        $c->get('emailservice'), 
        $c->get('smsservice')
    );
});

$userservice = $container->get('userservice');

$user = new User(name: 'Alan', email: 'alan@alan.fr', phone: '101-102-89');

echo $userservice->notifyUser($user, 'Hello Alan') ;