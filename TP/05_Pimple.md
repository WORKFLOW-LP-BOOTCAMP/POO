# Implémentation d'un Conteneur d'Injection de Dépendances avec Pimple Personnel

Appliquer le principe de l'inversion des dépendances (DIP) en utilisant un conteneur d'injection de dépendances personnalisé pour gérer les services dans une application PHP. 

Dans cet exercice, vous allez construire une petite application de gestion d'utilisateur avec des notifications par email et SMS.

1. **Définir les interfaces et les classes de service**
2. **Créer la classe principale d'application**
3. **Configurer et utiliser le conteneur de dépendances personnalisé**

## Structure du Projet

```
- src/
  - App.php
  - Container.php
  - NotificationService.php
  - EmailService.php
  - SMSService.php
  - User.php
  - UserService.php
- vendor/
- index.php
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
   - Le fichier `app` utilise le conteneur pour obtenir les services nécessaires et exécuter l'application.

4. **Configuration et Utilisation du Conteneur :**
   - Les services sont enregistrés dans le conteneur.
   - L'application principale est configurée pour utiliser le conteneur.
   - L'application est exécutée en récupérant les services et en les utilisant pour notifier l'utilisateur.
