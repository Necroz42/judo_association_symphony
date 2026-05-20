# judo_association_symphony

# README — Site de Gestion d’Association Sportive de Judo

## Présentation du projet

Ce projet est une application web développée pour moderniser la gestion d’une association sportive de judo.
L’objectif principal est de centraliser toutes les informations importantes de l’association dans une plateforme unique, intuitive et sécurisée.

L’application permet :

* la gestion des membres,
* l’organisation des entraînements,
* le suivi des combats,
* la gestion des activités sportives,
* l’administration complète de l’association.

Le projet a été développé avec Symfony en suivant une architecture MVC afin de garantir un code propre, maintenable et évolutif.

---

# Fonctionnalités

## Authentification et sécurité

* Inscription des utilisateurs
* Connexion sécurisée
* Gestion des rôles utilisateurs
* Protection des routes selon les permissions
* Gestion des sessions utilisateur

## Gestion des utilisateurs

* Création de membres
* Modification des profils
* Suppression d’utilisateurs
* Attribution de rôles :

  * Administrateur
  * Coach
  * Membre

## Gestion des entraînements

* Création de séances d’entraînement
* Gestion des horaires
* Gestion des lieux
* Attribution d’un coach
* Inscription des membres aux séances

## Gestion des combats

* Création de combats
* Attribution des participants
* Gestion des résultats
* Historique des affrontements

## Gestion des activités

* Création d’activités sportives
* Liaison entre activités, combats et entraînements
* Gestion centralisée des disciplines

## Interface administrateur

* Tableau de bord d’administration
* Gestion complète des données
* Visualisation des utilisateurs et activités

---

# Technologies utilisées

## Backend

* Symfony 6.4
* PHP 8.4
* Doctrine ORM
* Symfony Security
* Symfony Validator

## Frontend

* HTML5
* CSS3
* Bootstrap 5
* Twig

## Base de données

* MySQL

## Outils de développement

* Composer
* Symfony CLI
* Git
* Doctrine Migrations

---

# Architecture du projet

Le projet suit l’architecture MVC :

## Model

Contient :

* les entités Doctrine,
* la logique métier,
* les relations avec la base de données.

## View

Gestion de l’interface utilisateur avec Twig.

## Controller

Gestion des requêtes HTTP et de la logique applicative.

---

# Structure de la base de données

## Principales entités

### User

Représente les utilisateurs de la plateforme.

### Activity

Représente les activités sportives.

### TrainingSession

Représente les séances d’entraînement.

### Combat

Représente les combats entre membres.

### UserTrainingSession

Table de liaison entre les utilisateurs et les entraînements.

---

# Installation du projet

## 1. Cloner le projet

```bash
git clone <url-du-repository>
cd judo_association_symphony
```

## 2. Installer les dépendances

```bash
composer install
```

## 3. Configurer l’environnement

Créer un fichier `.env.local` :

```env
DATABASE_URL="mysql://root:password@127.0.0.1:3306/judo_association"
```

---

## 4. Créer la base de données

```bash
php bin/console doctrine:database:create
```

---

## 5. Exécuter les migrations

```bash
php bin/console doctrine:migrations:migrate
```

---

## 6. Lancer le serveur

```bash
symfony server:start
```

Le projet sera accessible sur :

```txt
http://127.0.0.1:8000
```

---

# Gestion des rôles

| Rôle        | Permissions               |
| ----------- | ------------------------- |
| ROLE_ADMIN  | Gestion complète du site  |
| ROLE_COACH  | Gestion des entraînements |
| ROLE_MEMBER | Accès membre classique    |

---

# Sécurité

Le projet utilise le composant Security de Symfony :

* authentification sécurisée,
* hashage des mots de passe,
* gestion des permissions,
* contrôle d’accès par rôle.

---

# Objectifs pédagogiques

Ce projet permet de mettre en pratique :

* le développement web avec Symfony,
* la conception de base de données relationnelles,
* l’architecture MVC,
* la sécurité web,
* la gestion des relations Doctrine,
* la création d’interfaces administrateur.

---

# Améliorations possibles

* Système de paiement des cotisations
* Notifications par email
* Gestion des tournois
* Calendrier interactif
* API REST
* Application mobile
* Statistiques avancées

---

# Auteur

Projet réalisé dans le cadre d’un projet scolaire de développement web à l’ESIEA.