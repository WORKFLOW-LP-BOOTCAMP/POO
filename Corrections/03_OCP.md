# 03 Exercice OCP

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

### Refactorer

Refactorer le code pour appliquer le principe Open/Closed, en permettant d'ajouter de nouveaux types de clients et de remises sans modifier la classe `Discount`.

### Refactorisation en Utilisant le Principe Open/Closed

#### Étape 1: Créer une Interface pour la Stratégie de Remise

```php
<?php

interface DiscountStrategy
{
    public function calculate(float $price): float;
}
```

#### Étape 2: Implémenter les Stratégies de Remise pour Chaque Type de Client

```php
<?php

class RegularDiscount implements DiscountStrategy
{
    public function calculate(float $price): float
    {
        return $price * 0.1;
    }
}

class VIPDiscount implements DiscountStrategy
{
    public function calculate(float $price): float
    {
        return $price * 0.2;
    }
}
```

#### Étape 3: Modifier la Classe Discount pour Utiliser les Stratégies

```php
<?php

class Discount
{
    private DiscountStrategy $strategy;

    public function __construct(DiscountStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function calculateDiscount(float $price): float
    {
        return $this->strategy->calculate($price);
    }
}
```

- Exemple d'utilisation 
  
```php
<?php

$price = 100.0;

// Remise pour un client régulier
$regularDiscount = new Discount(new RegularDiscount());
echo "Regular Discount: " . $regularDiscount->calculateDiscount($price) . "\n"; // 10% de réduction

// Remise pour un client VIP
$vipDiscount = new Discount(new VIPDiscount());
echo "VIP Discount: " . $vipDiscount->calculateDiscount($price) . "\n"; // 20% de réduction

// Ajout d'un nouveau type de remise sans modifier le code existant
class StudentDiscount implements DiscountStrategy
{
    public function calculate(float $price): float
    {
        return $price * 0.15; // 15% de réduction
    }
}

$studentDiscount = new Discount(new StudentDiscount());
echo "Student Discount: " . $studentDiscount->calculateDiscount($price) . "\n"; // 15% de réduction
```

### Explications

1. **Interface et Stratégies :** Nous avons défini une interface `DiscountStrategy` et créé des implémentations concrètes pour chaque type de remise (Regular, VIP, Student, etc.).

2. **Classe Discount :** La classe `Discount` utilise la stratégie de remise pour calculer la remise. Cela permet d'ajouter de nouvelles stratégies de remise en créant simplement de nouvelles classes qui implémentent `DiscountStrategy`, sans modifier la classe `Discount`.

3. **Ouverture à l'Extension :** Pour ajouter un nouveau type de remise, il suffit de créer une nouvelle classe qui implémente `DiscountStrategy`. La classe `Discount` reste inchangée, ce qui suit le principe Open/Closed.

En refactorant de cette manière, nous avons rendu le code extensible et maintenable, permettant de respecter le principe Open/Closed tout en facilitant l'ajout de nouvelles fonctionnalités.