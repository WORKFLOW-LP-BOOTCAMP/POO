# Exercice function LSP

- Classe de Base `Shape`

```php
<?php

interface Shape
{
    public function calculateArea(): float;
}
```

- Classe Dérivée `Rectangle`

Définissons maintenant une classe `Rectangle` qui implémente l'interface `Shape`.

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

- Classe Dérivée `Square`


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

- Fonction Utilisant le LSP


```php
<?php

function printArea(Shape $shape)
{
    echo "The area of the shape is: " . $shape->calculateArea() . "\n";
}

// Exemple d'utilisation

$rectangle = new Rectangle(5, 10);
$square = new Square(5);

printArea($rectangle);  // The area of the shape is: 50
printArea($square);     // The area of the shape is: 25
```

- **Interface `Shape` :** Elle définit le contrat que toutes les formes doivent respecter, c'est-à-dire implémenter la méthode `calculateArea`.
  
- **Classe `Rectangle` :** Elle implémente l'interface `Shape` et fournit une méthode pour calculer l'aire d'un rectangle.
  
- **Classe `Square` :** Elle hérite de `Rectangle` et fixe les côtés égaux, tout en respectant l'interface `Shape`.
