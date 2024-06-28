# Tests unitaires approche pratique

Nous allons découvrir les tests par la pratique.

Nous allons créer une classe `Product` pour représenter un produit et une classe `ProductRepository` pour gérer la persistance des produits. Voici les principales fonctionnalités. 

Même si cela change de notre approche SOLID de l'implémentation d'une gestion de commande de produit, nous allons suivre cette organisation. 

1. Ajouter un produit.
2. Supprimer un produit.
3. Rechercher un produit par ID.
4. Lister tous les produits.

## TDD (Test-Driven Development)

Nous allons utiliser PHPUnit pour les tests. Voici les étapes du TDD.

1. Écrire un test qui échoue, on n'écrit pas le code métier mais le test avant.
2. Écrire le code minimal pour faire passer le test.
3. Refactoriser le code tout en gardant les tests verts.

## Étape 1 : Configuration de l'environnement

1. Installer PHPUnit via Composer dans le projet.
   ```bash
   composer require --dev phpunit/phpunit
   ```

2. Créer une structure de répertoires :
   ```
   Products/
   ├── src/
   │   ├── Product.php
   │   └── ProductRepository.php
   ├── tests/
   │   ├── ProductTest.php
   │   └── ProductRepositoryTest.php
   ├── composer.json
   └── phpunit.xml
   ```

3. Configuration de PHPUnit (`phpunit.xml`)

Le fichier XML permet de configurer l'environnement de tests.

   ```xml
   <?xml version="1.0" encoding="UTF-8"?>
   <phpunit bootstrap="vendor/autoload.php">
       <testsuites>
           <testsuite name="Project Test Suite">
               <directory>./tests</directory>
           </testsuite>
       </testsuites>
   </phpunit>
   ```

## Étape 2 : Écriture des Tests

**tests/ProductTest.php**
```php
<?php

use PHPUnit\Framework\TestCase;
use App\Product;

class ProductTest extends TestCase
{
    public function testCanCreateProduct()
    {
        $product = new Product('123', 'Product Name', 100.00);
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('123', $product->getId());
        $this->assertEquals('Product Name', $product->getName());
        $this->assertEquals(100.00, $product->getPrice());
    }
}
```

**tests/ProductRepositoryTest.php**
```php
<?php

use PHPUnit\Framework\TestCase;
use App\Product;
use App\ProductRepository;

class ProductRepositoryTest extends TestCase
{
    public function testCanAddProduct()
    {
        $repository = new ProductRepository();
        $product = new Product('123', 'Product Name', 100.00);
        
        $repository->add($product);
        $this->assertEquals($product, $repository->findById('123'));
    }

    public function testCanRemoveProduct()
    {
        $repository = new ProductRepository();
        $product = new Product('123', 'Product Name', 100.00);
        
        $repository->add($product);
        $repository->remove('123');
        $this->assertNull($repository->findById('123'));
    }

    public function testCanListAllProducts()
    {
        $repository = new ProductRepository();
        $product1 = new Product('123', 'Product 1', 100.00);
        $product2 = new Product('124', 'Product 2', 150.00);
        
        $repository->add($product1);
        $repository->add($product2);
        $this->assertCount(2, $repository->findAll());
    }
}
```

## Étape 3 : Écriture du Code

**src/Product.php**
```php
<?php

namespace App;

class Product
{
    private $id;
    private $name;
    private $price;

    public function __construct(string $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
```

**src/ProductRepository.php**
```php
<?php

namespace App;

class ProductRepository
{
    private $products = [];

    public function add(Product $product)
    {
        $this->products[$product->getId()] = $product;
    }

    public function remove(string $id)
    {
        unset($this->products[$id]);
    }

    public function findById(string $id): ?Product
    {
        return $this->products[$id] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->products);
    }
}
```

## Étape 4 : Exécution des Tests

Exécutons les tests avec PHPUnit :
```bash
vendor/bin/phpunit
```
