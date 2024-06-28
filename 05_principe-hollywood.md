# Le Principe d'Hollywood

Le principe d'Hollywood est un concept de programmation qui illustre l'inversion de contrôle (IoC) dans le contexte de la gestion des dépendances et des interactions entre les composants logiciels. 

Ce principe est souvent associé à l'utilisation de frameworks IoC et de conteneurs de dépendances.

## 1. Définition

Le principe d'Hollywood peut être formulé de manière simple :

- **"Ne nous appelez pas, nous vous appellerons."**

Cela signifie que les composants de bas niveau (les détails d'implémentation ou les classes spécialisées) contrôlent le flux d'exécution et les interactions avec les composants de plus haut niveau (services ou classes abstraites). En d'autres termes, les composants de haut niveau peuvent spécifier leurs comportements et délèguent aux composants de bas niveau les détails de leur exécution.

## 2. Application du Principe d'Hollywood

Le principe d'Hollywood est principalement appliqué dans les frameworks IoC et les architectures où :

- **Contrôle Inversé :** Les dépendances ne sont pas créées ou gérées directement par la classe utilisatrice, mais sont fournies ou injectées par un conteneur IoC ou un système similaire.
  
- **Définition des Comportements :** Les classes de haut niveau définissent des méthodes ou des interfaces abstraites décrivant des comportements attendus, tandis que les classes de bas niveau implémentent ces comportements de manière spécifique.

## 3. Avantages du Principe d'Hollywood

- **Flexibilité :** Permet de modifier ou de remplacer facilement les comportements des composants de bas niveau sans modifier les composants de haut niveau.
  
- **Réutilisabilité :** Favorise la réutilisation des classes abstraites ou des interfaces par plusieurs implémentations concrètes.

- **Séparation des Préoccupations :** Clarifie les responsabilités des différents composants en séparant les aspects généraux (haut niveau) des détails d'implémentation (bas niveau).

## 4. Exemple Illustratif

Prenons un exemple simple où un contrôleur dans une application web utilise le principe d'Hollywood via un framework MVC (Modèle-Vue-Contrôleur)

```php
interface Logger {
    public function log(string $message);
}

class FileLogger implements Logger {
    public function log(string $message) {
        file_put_contents('log.txt', $message, FILE_APPEND);
    }
}

class UserController {
    private $logger;

    // Injection de dépendance via le constructeur
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function createUser($userData) {
        // Log d'une action
        $this->logger->log('User created: ' . json_encode($userData));
        // Autres opérations...
    }
}

// Utilisation avec un conteneur IoC ou une configuration manuelle
$logger = new FileLogger(); // $c->get('logger'); 
$userController = new UserController($logger);
$userController->createUser(['username' => 'john_doe', 'email' => 'john@example.com']);
```

Dans cet exemple :
- `UserController` dépend d'une interface `Logger`, mais ne crée pas directement une instance concrète de `FileLogger`.
- Le contrôleur reçoit une instance de `Logger` (par exemple `FileLogger`) injectée via son constructeur, conformément au principe d'injection de dépendance et à l'esprit du principe d'Hollywood.
- Le contrôleur utilise le logger pour enregistrer des actions sans connaître les détails d'implémentation spécifiques du logger.
