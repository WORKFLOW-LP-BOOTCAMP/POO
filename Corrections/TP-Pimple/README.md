# Implémentation d'un Conteneur d'Injection de Dépendances avec Pimple Personnel

Appliquer le principe de l'inversion des dépendances (DIP) en utilisant un conteneur d'injection de dépendances personnalisé pour gérer les services dans une application PHP. 

Dans cet exercice, vous allez construire une petite application de gestion d'utilisateur avec des notifications par email et SMS.

1. **Définir les interfaces et les classes de service**
2. **Créer la classe principale d'application**
3. **Configurer et utiliser le conteneur de dépendances personnalisé**

## Structure du Projet

```
- src/
  - Container.php
  - NotificationService.php
  - EmailService.php
  - SMSService.php
  - User.php
  - UserService.php
- vendor/
- app.php
- composer.json
```

## Etapes

1. **Définition des Interfaces et des Classes :**
   - Nous avons créé des interfaces et des classes pour les services de notification (email et SMS).
   - La classe `User` représente un utilisateur.
   - La classe `UserService` gère les notifications pour les utilisateurs.

2. **Conteneur de Dépendances :**
   - La classe `Container` permet de gérer les services et leurs dépendances.
   - La méthode `set` enregistre les services dans le conteneur.
   - La méthode `get` récupère les instances des services.

3. **Application Principale :**
   - La classe `App` utilise le conteneur pour obtenir les services nécessaires et exécuter l'application.

4. **Configuration et Utilisation du Conteneur :**
   - Les services sont enregistrés dans le conteneur.
   - L'application principale est configurée pour utiliser le conteneur.
   - L'application est exécutée en récupérant les services et en les utilisant pour notifier l'utilisateur.


## Étape 1 : Définir les Interfaces et les Classes de Service

### 1.1. Définir l'interface `NotificationService` et ses implémentations

```php
<?php

interface NotificationService
{
    public function send($to, $message) : string ;
}

class EmailService implements NotificationService
{
    public function send($to, $message) : string
    {
        return "Sending Email to $to: $message\n";
    }
}

class SMSService implements NotificationService
{
    public function send($to, $message) : string
    {
        return "Sending SMS to $to: $message\n";
    }
}
```

### 1.2. Définir une classe `User`

```php
<?php

class User
{
    private $name;
    private $email;
    private $phone;

    public function __construct($name, $email, $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getName()
    {
        return $this->name;
    }
}
```

### 1.3. Définir une classe `UserService`

```php
<?php

class UserService
{
    private NotificationService $emailService;
    private NotificationService $smsService;

    public function __construct(NotificationService $emailService, NotificationService $smsService)
    {
        $this->emailService = $emailService;
        $this->smsService = $smsService;
    }

    public function notifyUser(User $user, $message)
    {
        $this->emailService->send($user->getEmail(), $message);
        $this->smsService->send($user->getPhone(), $message);
    }
}
```

##  Configurer et Utiliser le Conteneur de Dépendances Personnalisé


- fichier app.php

```php
<?php

require 'vendor/autoload.php' ;

use Pimple\{Container, EmailService, SMSService, UserService} ;

$container = new Container();

// Enregistrer les services dans le conteneur
$container->set('emailservice', function ($c) {
    return new EmailService();
});

$container->set('smsservice', function ($c) {
    return new SMSService();
});

$container->set('userservice', function ($c) {
    return new UserService($c->get('emailservice'), $c->get('smsservice'));
});

// Enregistrer les paramètres de configuration si nécessaire
$container->set('app', function ($c) {
    return new App($c);
});


```

