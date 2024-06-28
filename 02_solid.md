# Principes de Conception SOLID

Les principes SOLID sont un ensemble de cinq principes de conception orientée objet qui favorisent la création de logiciels robustes, flexibles et maintenables. 

L'utilisation du polymorphisme avec les interfaces permet de respecter plusieurs de ces principes, en particulier le principe de séparation des interfaces (ISP) et le principe d'ouverture/fermeture (OCP).

Le polymorphisme, c'est la capacité d'un langage à supporter différentes implémentations d'un même système.

## 1. Principe de Ségrégation des Interfaces (Interface Segregation Principle - ISP)

**Définition :** Le principe de ségrégation des interfaces stipule qu'une classe ne devrait jamais être obligée d'implémenter des interfaces dont elle n'utilise pas les fonctionnalités. 

En d'autres termes, il est préférable d'avoir plusieurs interfaces spécifiques et étroites plutôt qu'une seule interface large et générale.

**Avantages :**
- **Modularité accrue :** Des interfaces spécifiques permettent de diviser les responsabilités, rendant le code plus modulaire et plus facile à comprendre.
- **Flexibilité :** Les classes peuvent implémenter uniquement les interfaces dont elles ont besoin, ce qui réduit le couplage et augmente la flexibilité.
- **Maintenabilité :** Il est plus facile de modifier ou d'étendre des interfaces spécifiques sans affecter d'autres parties du système.

**Exemple :**

```php
interface Printer {
    public function printDocument(string $document): void;
}

interface Scanner {
    public function scanDocument(): string;
}

class MultiFunctionPrinter implements Printer, Scanner {
    public function printDocument(string $document): void {
        echo "Printing document: $document\n";
    }

    public function scanDocument(): string {
        return "Scanned document content\n";
    }
}

class SimplePrinter implements Printer {
    public function printDocument(string $document): void {
        echo "Printing document: $document\n";
    }
}
```

Dans cet exemple, `MultiFunctionPrinter` implémente à la fois `Printer` et `Scanner`, tandis que `SimplePrinter` n'implémente que `Printer`. 

Cela respecte le principe de ségrégation des interfaces en évitant de forcer `SimplePrinter` à implémenter des fonctionnalités de numérisation qu'elle ne possède pas.

## 2. Principe d'Ouverture/Fermeture (Open/Closed Principle - OCP)

**Définition :** Le principe d'ouverture/fermeture stipule que les modules logiciels (classes, fonctions, etc.) doivent être ouverts à l'extension mais fermés à la modification. Cela signifie que vous devriez pouvoir ajouter de nouvelles fonctionnalités sans modifier le code existant.

**Avantages :**
- **Extensibilité :** Permet d'ajouter de nouvelles fonctionnalités sans changer le code existant, réduisant ainsi le risque d'introduire des bogues.
- **Stabilité :** Le code existant reste inchangé, ce qui améliore la stabilité et la fiabilité du système.
- **Réutilisation :** Favorise la réutilisation du code en permettant de créer des extensions ou des adaptations sans modifier les classes de base.

**Exemple :**

Supposons que vous ayez une interface `PaymentProcessor` pour différents types de paiement :

```php
interface PaymentProcessor {
    public function processPayment(float $amount): void;
}

class CreditCardProcessor implements PaymentProcessor {
    public function processPayment(float $amount): void {
        echo "Processing credit card payment of $$amount\n";
    }
}

class PayPalProcessor implements PaymentProcessor {
    public function processPayment(float $amount): void {
        echo "Processing PayPal payment of $$amount\n";
    }
}

class PaymentService {
    private PaymentProcessor $processor;

    public function __construct(PaymentProcessor $processor) {
        $this->processor = $processor;
    }

    public function process(float $amount): void {
        $this->processor->processPayment($amount);
    }
}
```

Dans cet exemple :
- `PaymentProcessor` est une interface définissant un contrat pour le traitement des paiements.
- `CreditCardProcessor` et `PayPalProcessor` sont des implémentations spécifiques de `PaymentProcessor`.
- `PaymentService` utilise `PaymentProcessor` pour traiter les paiements de manière polymorphe.

Si vous voulez ajouter un nouveau type de processeur de paiement, comme `BitcoinProcessor`, vous n'avez pas besoin de modifier `PaymentService` ni les autres processeurs de paiement existants. Vous pouvez simplement créer une nouvelle classe qui implémente `PaymentProcessor` :

```php
class BitcoinProcessor implements PaymentProcessor {
    public function processPayment(float $amount): void {
        echo "Processing Bitcoin payment of $$amount\n";
    }
}
```

Ensuite, vous pouvez l'utiliser de la même manière :

```php
$bitcoinProcessor = new BitcoinProcessor();
$paymentService = new PaymentService($bitcoinProcessor);
$paymentService->process(100.0); // Output: Processing Bitcoin payment of $100.0
```

Ce respect du principe d'ouverture/fermeture permet d'étendre les fonctionnalités du système sans modifier le code existant, ce qui réduit les risques de régression et améliore la maintenabilité.

### Exercice OCP, Discount

Imaginons une classe `Discount` qui calcule des remises sur les produits en fonction de différents types de clients (par exemple, "Regular" et "VIP"). Actuellement, le code n'est pas extensible sans modification directe de la classe `Discount`.

```php
<?php

class Discount
{
    public function calculateDiscount(float $price, string $customerType): float
    {
        if ($customerType == 'Regular') {
            return $price * 0.1; // 10% de réduction
        } elseif ($customerType == 'VIP') {
            return $price * 0.2; // 20% de réduction
        } else {
            return 0;
        }
    }
}
```

Refactorer le code pour appliquer le principe Open/Closed, en permettant d'ajouter de nouveaux types de clients et de remises sans modifier la classe `Discount`.
 

### 3. Principe de Responsabilité Unique (Single Responsibility Principle - SRP)

**Définition :** Une classe ne devrait avoir qu'une seule responsabilité ou fonction, ce qui implique qu'elle ne devrait être modifiée que pour une seule raison.

Cela signifie qu'une classe ne devrait être modifiée que pour une seule raison. 
En d'autres termes, elle devrait avoir une seule responsabilité ou un seul objectif, ce qui réduit le risque de modifications accidentelles affectant d'autres aspects de la classe.

**Avantages :**
- **Modularité :** Les classes avec des responsabilités uniques sont plus faciles à comprendre et à gérer.
- **Facilité de Maintenance :** Les changements sont isolés à une seule responsabilité, réduisant ainsi les effets de bord.

**Exemple :**

Dans notre exemple de `PaymentService`, nous allons nous assurer que chaque classe a une seule responsabilité. Par exemple, `PaymentService` ne devrait gérer que le processus de paiement, et non la génération de reçus ou la gestion des utilisateurs.

```php
class PaymentService {
    private PaymentProcessor $processor;

    public function __construct(PaymentProcessor $processor) {
        $this->processor = $processor;
    }

    public function process(float $amount): void {
        $this->processor->processPayment($amount);
    }
}

class ReceiptGenerator {
    public function generateReceipt(float $amount): string {
        return "Receipt for payment of $$amount";
    }
}
```

#### Exercice SRP 

Changez la classe suivante en appliquant le principe de SRP.

```php
class Report {
    public function generateReport() {
        // Code pour générer le rapport
        return "Report content";
    }

    public function sendReportByEmail($email) {
        $report = $this->generateReport();
        // Code pour envoyer le rapport par email
        echo "Sending report to $email\n";
    }

    public function sendReportBySms($phoneNumber) {
        $report = $this->generateReport();
        // Code pour envoyer le rapport par SMS
        echo "Sending report to $phoneNumber\n";
    }
}

// Utilisation
$report = new Report();
$report->sendReportByEmail("example@example.com");
$report->sendReportBySms("123456789");

```

### 4. Principe de Substitution de Liskov (Liskov Substitution Principle - LSP)

**Définition :** Les objets d'une classe dérivée doivent pouvoir être remplacés par des objets de la classe de base sans altérer le comportement du programme.

**Avantages :**
- **Interchangeabilité :** Permet d'utiliser les sous-classes de manière interchangeable sans modifier le comportement du code existant.
- **Robustesse :** Assure que les sous-classes respectent le contrat défini par leurs super-classes.

**1. Exemple :**

Toutes les implémentations de `PaymentProcessor` doivent se comporter de manière cohérente. Par exemple, la méthode `processPayment` doit être implémentée de manière à respecter l'interface contractuelle sans introduire de comportement inattendu.

```php

interface PaymentProcessor{
    public function processPayment(float $amount): string ;
}

class BitcoinProcessor implements PaymentProcessor {
    public function processPayment(float $amount): string {
        if ($amount <= 0) 
            throw new InvalidArgumentException("Amount must be positive.");
        
        return "Processing Bitcoin payment of $$amount\n";
    }
}
```

**2. Exemple**

- Une interface pour la forme.

```php
<?php

interface Shape
{
    public function calculateArea(): float;
}
```

- Une classe dérivée de Shape.

```php
<?php

class Rectangle implements Shape
{
    protected float $width;
    protected float $height;

    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function calculateArea(): float
    {
        return $this->width * $this->height;
    }
}
```

- Une autre classe dérivée.

```php
<?php

class Square extends Rectangle
{
    public function __construct(float $sideLength)
    {
        parent::__construct($sideLength, $sideLength);
    }
}
```

## Exercice function LSP

Créez une fonction qui calcule et affiche l'aire d'une forme. 
Selon le LSP, cette fonction doit pouvoir accepter à la fois des rectangles et des carrés sans altérer son comportement.

## Exercice LSP payment - processor

Imaginons un système de gestion de paiements qui inclut différents types de paiements avec des commissions spécifiques.

voici les différents modes de paiements : 

1. Carte de crédit.
2. PayPal.
3. Bank Transfer.

Implémentez ce composant en appliquant le principe LSP.

### 5. Principe d'Inversion des Dépendances (Dependency Inversion Principle - DIP)

**Définition :** Les modules de haut niveau ne doivent pas dépendre des modules de bas niveau. Tous deux doivent dépendre d'abstractions. Les abstractions ne doivent pas dépendre des détails, mais les détails doivent dépendre des abstractions.

**Avantages :**
- **Découplage :** Réduit la dépendance entre les modules, ce qui améliore la flexibilité et la maintenabilité du code.
- **Testabilité :** Facilite les tests unitaires et les tests d'intégration en permettant de substituer facilement les dépendances.

**Exemple :**

Nous allons utiliser une injection de dépendance pour fournir le `PaymentProcessor` à `PaymentService`, ce qui permet de changer facilement le type de processeur de paiement sans modifier `PaymentService`.

```php
interface PaymentProcessor {
    public function processPayment(float $amount): void;
}

class PaymentService {
    private PaymentProcessor $processor;

    public function __construct(PaymentProcessor $processor) {
        $this->processor = $processor;
    }

    public function process(float $amount): void {
        $this->processor->processPayment($amount);
    }
}

// Les classes de processeurs de paiement existantes
class CreditCardProcessor implements PaymentProcessor {
    public function processPayment(float $amount): void {
        echo "Processing credit card payment of $$amount\n";
    }
}

class PayPalProcessor implements PaymentProcessor {
    public function processPayment(float $amount): void {
        echo "Processing PayPal payment of $$amount\n";
    }
}

class BitcoinProcessor implements PaymentProcessor {
    public function processPayment(float $amount): void {
        echo "Processing Bitcoin payment of $$amount\n";
    }
}

// Utilisation de l'injection de dépendance
$processor = new BitcoinProcessor();
$paymentService = new PaymentService($processor);
$paymentService->process(150.0); // Output: Processing Bitcoin payment of $150.0
```

## TP Pimple simplifié - Inversion de dépendances

Implémentation d'un Conteneur d'Injection de Dépendances avec Pimple Personnel.

[Pimple](./TP/05_Pimple.md)