# Implémentation d'un DAL/DAO en TDD.

Mise en pratique du développement en TDD.

Principes et utilisation d'un DAL.


## TDD - Test Driven Development

[Wikipedia](https://fr.wikipedia.org/wiki/Test_driven_development)

### Principes de base

*Loi 1* : Vous devez écrire un test qui échoue avant de pouvoir écrire le code de production correspondant.

*Loi 2* : Vous devez écrire une seule assertion à la fois, qui fait échouer le test ou qui échoue à la compilation.

*Loi 3* : Vous devez écrire le minimum de code de production pour que l'assertion du test actuellement en échec soit satisfaite.

### En pratique

1. Écrire un seul test qui décrit une partie du problème à résoudre
2. Vérifier que le test échoue, autrement dit qu'il est valide, c'est-à-dire que le code se rapportant à ce test n'existe pas
3. Écrire juste assez de code pour que le test réussisse
4. Vérifier que le test passe, ainsi que les autres tests existants
5. Puis remanier le code, c'est-à-dire l'améliorer sans en altérer le comportement
6. GOTO 1.


## DAL, DAO & Cie

[TUTO (openclassrooms)](https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1666289-manipulation-de-donnees-stockees)

[doc](https://blog.mazenod.fr/design-pattern-mvc-zoom-sur-la-couche-modele-dal-dao-orm-crud.html)

### DAL : Data Access Layer

La DAL permet de faire abstraction du support de données. En théorie, peu importe le type de données: base SQL, fichiers XML, fichiers texte, le DAL permet de manipuler ces données.
​
### DAO : Data Access Object

Le but du DAO est de tranformer les données gérées par le DAL en objets facilement manipulable.
Il crée ainsi un objet en faisant correspondre les attributs de cet objet avec les données lues par le DAL.​

On parle aussi de *manager*.

### ORM : Object Relation Maping

L'ORM a pour but de restituer les liens entre les tables (dans le cas d'une BDD) en créant les même liens entre les objets créés par le DAO. Et inversement.
Il va typiquement se préoccuper de matérialiser les clés étrangères par des dépendances entre objets.

![](https://blog.mazenod.fr/images/orm/DAL_final.png)



## TP

### Installation

```
git clone https://github.com/leahpar/nws-tdd-dal.git <mon-projet>
cd <mon-projet>
```

Créer une base de données (MySQL, PostgreSQL, SQLite...).

Éditer le fichier `config.php`.

### Objectif

Gérer des Trucs !

- Créer des attributs et accesseurs d'une entité `Truc`.
- Compléter la classe `TrucDAO` pour pouvoir ajouter, modifier, supprimer, lister, chercher... des trucs.

### Coder

1. Ajouter un test dans `tdd.php`
2. Tester : `php tdd.php`
3. Implémenter la fonction
4. Tester : `php tdd.php`
5. Nettoyer et commenter le code
6. GOTO 1

### Documentation PDO

PDO : PHP Data Objects

[Connexion](https://www.php.net/manual/fr/pdo.connections.php)

[Requêtes](https://www.php.net/manual/fr/pdo.prepared-statements.php)

## Pour aller plus loin

### Singleton

Utilisation d'un design pattern singleton ([wikipedia](https://fr.wikipedia.org/wiki/Singleton_(patron_de_conception))) pour la connexion à la base de données

### Structure tables

Gérer la structure des tables dans le DAO (create, truncate, drop, if exists).

### ORM

Implémenter une couche ORM : plusieurs entités avec des relations entre elles.

## L'intérêt de Doctrine

- DAL/DBAL
- ORM
- Types avancés
- DQL
- Cache
- Annotations
- Café
- ...
