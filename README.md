# Onde API

## Installation

> liens : 
> - API : https://onde-api.frb.io/api
> - BackOffice : https://onde-api.frb.io/admin

### Clone le projet

    git clone https://github.com/RomainDreidemy/Onde-API.git

### Installer les dépendances

    composer install
    
### Migration de la base de données

    php bin/console doctrine:migrations:migrate
    
### Variable environnement

> Modifier les variables d'environnement dans le fichier .env

## Rendu

### Choix technique

- Hébergement : FortRabbit
- Serveur web : Apache
- Base de données : MYSQL 5.7
- Symfony 5.1.2
- PHP 7.4

#### Composants

- Doctrine
- Api plateform
- EasyAdmin
- symfony/flex
- symfony/maker-bundle
- symfony/orm-pack
- symfony/security-bundle
- doctrine/doctrine-fixtures-bundle
- symfony/debug-pack

#### Connexion
Pour vous connecter à la plateform, voici 2 identifiants admin : 
- aymericmayeux@gmail.com
- bastien.calou@gmail.com

Mot de passe : intervenant

### Argumentation :

#### Api Plateform
J’ai choisi de l’utiliser, car il permet de créer un api restful, générer un CRUD, créer des filtres et une documentatio
rapidement tout en respectant les standards de PHP et de symfony.

**Route personnalisé :**  
Pour des raisons techniques, j’ai du crx éer des route personnalisé dans l’API car il y avait besoin de faiire des traitements supplémentaires. Par exemple : 
• Lors de l’ajout d’un abonnement, j’ai besoin de checker si l’objectif du nombre d’abonnement est atteind et si c’est le cas l’api envoi un mail et le champs done de l’abonnement passe en true
• Pour la création d’un utlilsateur, pour encoder le mot de passe.
• Pour certaines entités pour récupérer plus d’in et éviter au front de faire plusieurs call api.

> Vous pouvez voir les différentes routes créer dans ./src/Controller/Api

#### EasyAdmin :
Permet de générer une interface administratif (CRUD).
J’ai décidé de l’utiliser car il est facile et rapide à mettre en place. En plus de cela il est facile d’ajouter ou de retirer des colonnes. Il à aussi l’avantage de choisir ce qu’on affiche en fonction du rôle de l’utilisateur.

#### JSON_LOGIN (authentification) :
Il m’a permis de connecter un utilisateur sur le front grâce à un appel axios (librairie front
permettant de faire des appels AJAX).

#### Rôles :
Nous avons défini 4 rôles différents pour les utilisateurs. Le rôle User, Admin et Partenaire.
- User : Utilisateur normal ayant accès au front de l’application.
- Partenaire : Rôle qui défini l’utilisateur comme compte partenaire, ce qui permet de les différencier dans le front.
- Admin : Administrateur qui peut gérer toute la partie administration du site.
- Modo : Il pourra seulement administrer les initiatives.

#### Mailer : 
Lorsqu’un utilisateur à perdu son mot de passe ou si des objectifs sont atteind dans une initiative, un mail est envoyer aux utilisateurs concerné.

### Dossier pdf :
Ce dossier comporte des informations supplémentaire, ainsi que les modélisations de la base données

*Lien du dosser* 



