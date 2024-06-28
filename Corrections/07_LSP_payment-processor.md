# Exercice LSP payment - processor

Imaginons un système de gestion de paiements qui inclut différents types de paiements avec des commissions spécifiques.

voici les différents modes de paiements : 

1. Carte de crédit.
2. PayPal.
3. Bank Transfer.

Implémentez ce composant en appliquant le principe LSP.

Nous allons créer une interface de base `PaymentProcessor` et plusieurs classes dérivées pour différents types de paiements : `CreditCardProcessor`, `PayPalProcessor`, et `BankTransferProcessor`.

## 1. Interface de Base `PaymentProcessor`

```php
<?php

interface PaymentProcessor
{
    public function processPayment(float $amount): float;
}
```

## 2. Classe Dérivée `CreditCardProcessor`

Cette classe applique une commission de 2% sur les paiements par carte de crédit.

```php
<?php

class CreditCardProcessor implements PaymentProcessor
{
    private float $commissionRate;

    public function __construct(float $commissionRate = 0.02)
    {
        $this->commissionRate = $commissionRate;
    }

    public function processPayment(float $amount): float
    {
        return $amount * (1 + $this->commissionRate);
    }
}
```

## 3. Classe Dérivée `PayPalProcessor`

Cette classe applique une commission fixe de 1.5 sur tous les paiements via PayPal.

```php
<?php

class PayPalProcessor implements PaymentProcessor
{
    private float $fixedFee;

    public function __construct(float $fixedFee = 1.5)
    {
        $this->fixedFee = $fixedFee;
    }

    public function processPayment(float $amount): float
    {
        return $amount + $this->fixedFee;
    }
}
```

## 4. Classe Dérivée `BankTransferProcessor`

Cette classe applique une commission de 1% sur les paiements par virement bancaire.

```php
<?php

class BankTransferProcessor implements PaymentProcessor
{
    private float $commissionRate;

    public function __construct(float $commissionRate = 0.01)
    {
        $this->commissionRate = $commissionRate;
    }

    public function processPayment(float $amount): float
    {
        return $amount * (1 + $this->commissionRate);
    }
}
```

Créons une fonction qui traite les paiements en utilisant le processeur de paiement approprié. Selon le LSP, cette fonction doit pouvoir accepter n'importe quelle implémentation de `PaymentProcessor` sans altérer son comportement.

```php
<?php

function processAndPrintPayment(PaymentProcessor $processor, float $amount)
{
    $processedAmount = $processor->processPayment($amount);
    echo "Processed amount: $" . $processedAmount . "\n";
}

// Exemple d'utilisation

$creditCardProcessor = new CreditCardProcessor();
$payPalProcessor = new PayPalProcessor();
$bankTransferProcessor = new BankTransferProcessor();

processAndPrintPayment($creditCardProcessor, 100.0);  // Processed amount: $102.0
processAndPrintPayment($payPalProcessor, 100.0);      // Processed amount: $101.5
processAndPrintPayment($bankTransferProcessor, 100.0);// Processed amount: $101.0
```

1. **Interface `PaymentProcessor` :** Elle définit le contrat que tous les processeurs de paiement doivent respecter, c'est-à-dire implémenter la méthode `processPayment`.
2. **Classes Dérivées :** 
   - `CreditCardProcessor` : Applique une commission proportionnelle au montant.
   - `PayPalProcessor` : Applique une commission fixe.
   - `BankTransferProcessor` : Applique une commission proportionnelle mais plus basse.
