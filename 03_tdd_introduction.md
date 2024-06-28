# Tests unitaires et TDD

## Tests unitaires

Un test unitaire est une méthode de test logiciel où les plus petites parties testables d'une application, appelées unités, sont vérifiées de manière isolée pour s'assurer qu'elles fonctionnent comme prévu. Une unité peut être une fonction, une méthode, un objet, ou un module, selon le contexte du langage de programmation utilisé.

### Caractéristiques des Tests Unitaires

1. **Isolation** : Chaque test unitaire est indépendant et ne dépend pas des autres tests. Les interactions avec des dépendances externes (comme des bases de données, des systèmes de fichiers, ou des services web) sont généralement simulées à l'aide de techniques comme le mock ou le stub.
2. **Automatisation** : Les tests unitaires sont écrits et exécutés de manière automatique pour permettre des retours rapides et fréquents sur l'état du code.
3. **Rapidité** : Les tests unitaires doivent être rapides à exécuter, car ils sont souvent exécutés de manière répétée tout au long du processus de développement.

### Exemple de Test Unitaire

Prenons un exemple simple en PHP pour illustrer un test unitaire avec PHPUnit.

#### Code à Tester (Math.php)

```php
<?php

class Math
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function subtract($a, $b)
    {
        return $a - $b;
    }
}
```

#### Test Unitaire (MathTest.php)

```php
<?php

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    protected $math;

    protected function setUp(): void
    {
        $this->math = new Math();
    }

    public function testAdd()
    {
        $this->assertEquals(4, $this->math->add(2, 2));
        $this->assertEquals(0, $this->math->add(-1, 1));
    }

    public function testSubtract()
    {
        $this->assertEquals(0, $this->math->subtract(2, 2));
        $this->assertEquals(-2, $this->math->subtract(-1, 1));
    }
}
```

### Avantages des Tests Unitaires

- **Détection précoce des bugs** : Les erreurs peuvent être détectées tôt dans le cycle de développement, ce qui réduit le coût de correction des bugs.
- **Facilitation de la refactorisation** : Les développeurs peuvent modifier et améliorer le code avec la confiance que les tests unitaires garantiront que les fonctionnalités existantes ne sont pas cassées.
- **Documentation vivante** : Les tests unitaires servent de documentation pour le code, expliquant ce qu'il est censé faire.

## TDD

Le TDD (Test-Driven Development, ou développement piloté par les tests) est une méthode de développement logiciel dans laquelle les tests sont écrits avant le code qui doit les satisfaire. Cette approche se déroule en trois étapes principales :

1. **Red (Rouge)** : Écrire un test qui échoue car la fonctionnalité n'est pas encore implémentée.
2. **Green (Vert)** : Écrire le code minimal nécessaire pour que le test passe.
3. **Refactor (Refactoriser)** : Améliorer et nettoyer le code tout en s'assurant que tous les tests continuent de passer.

### Avantages du TDD

- **Qualité du code** : En écrivant les tests avant le code, les développeurs se concentrent sur les exigences et la conception, ce qui conduit à un code de meilleure qualité.
- **Moins de bugs** : Les tests automatisés détectent les régressions et les bugs dès qu'ils apparaissent, ce qui réduit les erreurs en production.
- **Confiance** : Les tests automatisés fournissent une suite de vérification continue, permettant aux développeurs de refactoriser et de modifier le code sans craindre d'introduire de nouveaux bugs.
- **Documentation vivante** : Les tests servent de documentation vivante pour le code, décrivant clairement les comportements attendus et les cas d'utilisation.

### Cycle du TDD

1. **Écriture d'un test** : Avant même d'écrire le code de la fonctionnalité, le développeur écrit un test unitaire pour vérifier une condition spécifique.
2. **Exécution du test** : Le test est exécuté et, naturellement, échoue puisque la fonctionnalité n'est pas encore implémentée (état rouge).
3. **Implémentation minimale** : Le code est écrit juste assez pour faire passer le test (état vert).
4. **Refactorisation** : Le code est nettoyé et optimisé, tout en s'assurant que tous les tests continuent de passer.
5. **Répétition** : Le cycle est répété pour chaque nouvelle fonctionnalité ou amélioration.

En résumé, le TDD est une méthodologie qui aide à produire un code robuste et maintenable en plaçant les tests au cœur du processus de développement.