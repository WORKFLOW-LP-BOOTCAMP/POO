
## Code de Base

```php
<?php
class BankAccount {
    private float $balance;

    public function __construct(float $initialBalance) {
        $this->balance = $initialBalance;
    }

    // Accesseur
    public function getBalance() : float {
        return $this->balance;
    }

    // Mutateur
    public function deposit(float $amount) : void {
        if ($amount > 0) {
            $this->balance += $amount;
        }
    }

    public function withdraw(float $amount) : void {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
        }
    }

    // Méthode magique __toString
    public function __toString() : string {
        return "Balance: " . number_format($this->balance, 2);
    }
}

// Test de la classe
$account = new BankAccount(1500.75);
$account->deposit(250.25);
$account->withdraw(400.50);
echo $account;
```

## Résultat Attendu

Après avoir exécuté le code, le solde affiché devrait être :

```plaintext
Balance: 1350.50
```

### Défi Supplémentaire

Ajoutez une méthode `transfer` à la classe `BankAccount` qui permet de transférer un montant d'un compte à un autre. Assurez-vous de vérifier que le montant est positif et que le solde du compte source est suffisant.

```php
public function transfer(float $amount, BankAccount $toAccount) : void {
    if ($amount > 0 && $amount <= $this->balance) {
        $this->withdraw($amount);
        $toAccount->deposit($amount);
    }
}
```

Testez cette méthode en créant deux instances de `BankAccount` et en transférant de l'argent entre elles.