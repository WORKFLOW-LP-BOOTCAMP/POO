# Card

## efactorisation de la Classe pour Respecter les Principes SOLID


```php
class Card {
    private $pdo;
    private $productId;
    private $productName;
    private $productPrice;

    public function __construct($productId, $productName, $productPrice) {
        $this->pdo = new PDO('mysql:host=localhost;dbname=testdb', 'user', 'password');
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
    }

    public function save() {
        $stmt = $this->pdo->prepare("INSERT INTO cards (product_id, product_name, product_price) VALUES (:productId, :productName, :productPrice)");
        $stmt->bindParam(':productId', $this->productId);
        $stmt->bindParam(':productName', $this->productName);
        $stmt->bindParam(':productPrice', $this->productPrice);
        $stmt->execute();
    }

    public function getProductInfo() {
        return "Product ID: $this->productId, Name: $this->productName, Price: $this->productPrice";
    }

    public function applyDiscount($percentage) {
        $this->productPrice -= $this->productPrice * ($percentage / 100);
    }

    public function printCard() {
        echo $this->getProductInfo();
    }
}

// Utilisation
$card = new Card(1, 'Product A', 100.0);
$card->save();
$card->applyDiscount(10);
$card->printCard();
```

## Problèmes avec cette Classe

1. Responsabilité Unique (SRP) : La classe Card gère plusieurs responsabilités : la persistance des données, la gestion des produits, et l'affichage des informations.
1. Ouverture/Fermeture (OCP) : Pour ajouter une nouvelle fonctionnalité ou modifier une fonctionnalité existante, il faudrait modifier la classe Card.
1. Substitution de Liskov (LSP) : La classe Card ne peut pas être substituée par des sous-classes spécialisées sans compromettre son comportement.
1. Ségrégation des Interfaces (ISP) : La classe Card a des méthodes qui ne sont pas forcément nécessaires pour toutes ses utilisations, ce qui oblige les utilisateurs à implémenter des méthodes dont ils n'ont pas besoin.
1. Inversion des Dépendances (DIP) : La classe Card dépend directement de la classe PDO, une implémentation concrète, plutôt que d'une abstraction.