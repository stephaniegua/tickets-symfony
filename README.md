# 🎫 Application Symfony de gestion de tickets

Application web permettant la création, le suivi et la gestion de tickets clients.

Ce projet a été réalisé dans le cadre d’un exercice professionnel simulant les pratiques d’une agence web :
migrations, fixtures, validations, gestion des rôles et bonnes pratiques de développement.

---

## 🚀 Fonctionnalités

### 👤 Partie publique (client)

- Création de ticket sans authentification
- Champs :
  - Email
  - Description (20 à 250 caractères)
  - Catégorie (liste déroulante)

### 🔐 Partie authentifiée

#### 👨‍🔧 Personnel

- Accès à la liste des tickets
- Consultation d’un ticket
- Modification du statut

#### 👑 Administrateur

- Gestion complète :
  - Catégories
  - Statuts
  - Responsables
  - Tickets
- Accès total aux fonctionnalités

---

## 🔑 Gestion des rôles

- **ROLE_ADMIN** : accès complet (CRUD)
- **ROLE_TECH** : gestion des tickets + statut
- **ROLE_USER** : création de tickets (partie publique)

---

## 🛠️ Technologies utilisées

- Symfony 6+
- Doctrine ORM
- Twig
- Bootstrap 5
- Migrations Doctrine
- Fixtures Doctrine
- Validation Symfony (Assert)

---

## ⚙️ Installation du projet

### 1. Cloner le projet
```bash
git clone https://github.com/stephaniegua/tickets-symfony.git
cd tickets-symfony
```

### 2. Installer les dépendances
```bash
composer install
```

### 3. Configurer l'environnement
Copier `.env` en `.env.local` et modifier les accès à la base de données.

### 4. Créer la base de données
```bash
php bin/console doctrine:database:create
```

### 5. Lancer les migrations
```bash
php bin/console doctrine:migrations:migrate
```

Charger les données d’essai (fixtures)

Un jeu d’essais complet est fourni pour permettre de tester l’application :

un administrateur

un technicien

un utilisateur standard

catégories

statuts

responsables

tickets

utilisateurs (admin + personnel)


### 6. Charger les fixtures
```bash
php bin/console doctrine:fixtures:load
```

Identifiants de connexion:

Administrateur

Email : admin@test.com

Mot de passe : admin123

Technicien

Email : tech@test.com

Mot de passe : tech123

User

Email : user@test.com

Mot de passe : user123


### 7. Lancer le serveur
```bash
symfony server:start
```

Puis accéder à :
👉 http://localhost:8000


#Fonctionnalités principales:

Partie publique (client)

Création d’un ticket sans authentification

Champs accessibles :

email

description (20–250 caractères)

catégorie (liste déroulante)

Partie authentifiée


Personnel de l’agence

Accès à la liste des tickets

Consultation d’un ticket

Modification du statut


Administrateur

Gestion complète :

catégories

statuts

responsables

tickets

Accès à toutes les fonctionnalités du personnel


Gestion des rôles


- **ROLE_ADMIN** : accès complet à toutes les données (CRUD complet)
- 
- **ROLE_TECH** : accès aux tickets + modification du statut
- 
- **ROLE_USER** : création de tickets publics (non authentifié)




###Qualité & bonnes pratiques


Code indenté et commenté

Versioning Git (commits réguliers)

Migrations pour toute modification du schéma

Fixtures pour un jeu d’essais complet

Séparation claire des rôles utilisateurs

Templates Twig structurés

Structure du projet
```bash

public/
src/
 ├── Kernel.php
 ├── Controller/
 ├── Entity/
 ├── Form/
 ├── Repository/
 ├── Security/
 └── DataFixtures/

templates/
 ├── base.html.twig
 ├── admin/
 ├── ticket/
 ├── categorie/
 ├── statut/
 ├── tech/
 ├── responsable/
 ├── registration/
 ├── home/
 └── security/
```


Auteur
Projet réalisé par Stéphanie, développeuse web en reconversion, dans le cadre d’un exercice professionnel visant à valider les compétences Symfony (entités, formulaires, validations, fixtures, migrations, Twig, versioning).

## Dépôt GitHub

https://github.com/stephaniegua/tickets-symfony

