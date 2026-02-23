Application Symfony de gestion de tickets
Application interne permettant la création, le suivi et la gestion de tickets clients.
Ce projet a été réalisé dans le cadre d’un exercice professionnel simulant les pratiques d’une agence web : 
migrations, fixtures, validations, versioning, Bootstrap, et séparation claire des rôles (client, personnel, administrateur).

# Installation du projet

## 1. Cloner le projet
git clone https://github.com/stephaniegua/tickets-symfony.git
cd tickets-symfony

## 2. Installer les dépendances
composer install

## 3. Configurer l'environnement
Copier `.env` en `.env.local` et modifier les accès à la base de données.

## 4. Créer la base de données
php bin/console doctrine:database:create

## 5. Lancer les migrations
php bin/console doctrine:migrations:migrate

Charger les données d’essai (fixtures)
Un jeu d’essais complet est fourni pour permettre de tester l’application :

catégories

statuts

responsables

tickets

utilisateurs (admin + personnel)

## 6. Charger les fixtures
php bin/console doctrine:fixtures:load

Identifiants de connexion

Administrateur
Email : admin@test.com

Mot de passe : admin123

Technicien
Email : tech@test.com

Mot de passe : tech123

User
Email : user@test.com

Mot de passe : user123

## 7. Lancer le serveur
symfony server:start
