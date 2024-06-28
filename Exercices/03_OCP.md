# Exercice OCP

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
