# Exercice : Gestion d'un Compte Bancaire

## Objectif
Créer une classe `BankAccount` qui gère des opérations de dépôt et de retrait avec des valeurs en float. Vous devrez également implémenter une méthode pour afficher le solde du compte.

## Instructions

1. **Création de la classe `BankAccount` :**
    - Créez une classe nommée `BankAccount`.
    - Ajoutez un attribut privé `balance` de type `float` pour stocker le solde du compte.
    - Implémentez un constructeur qui accepte un paramètre de type `float` pour initialiser le solde.

2. **Implémentation des méthodes :**
    - Ajoutez une méthode `getBalance` qui retourne le solde du compte en tant que `float`.
    - Ajoutez une méthode `deposit` qui accepte un paramètre `float` et augmente le solde du compte si le montant est positif.
    - Ajoutez une méthode `withdraw` qui accepte un paramètre `float` et diminue le solde du compte si le montant est positif et inférieur ou égal au solde actuel.

3. **Méthode magique `__toString` :**
    - Implémentez la méthode magique `__toString` pour retourner le solde du compte formaté avec deux décimales.

4. Ajoutez une méthode `transfer` à la classe `BankAccount` qui permet de transférer un montant d'un compte à un autre. Assurez-vous de vérifier que le montant est positif et que le solde du compte source est suffisant.
   
5. **Test de la classe :**
    - Créez une instance de `BankAccount` avec un solde initial de `1500.75`.
    - Effectuez un dépôt de `250.25`.
    - Effectuez un retrait de `400.50`.
    - Affichez le solde du compte en utilisant la méthode `__toString`.
