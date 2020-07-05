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

#### Composants

- Doctrine
- Api plateform
- EasyAdmin

### Argumentaire

#### Api Plateform

J'ai choisi de l'utiliser car il permet de créer un api RestFul, créer des filtres et une documentation rapidement tout en respectant les standards de PHP et de symfony.  
Il est aussi facile de créer des routes nous même et de les intégrer à la documentation de l'Api. 
 
#### JSON_LOGIN

Il m’a permis de connecter un utilisateur sur le front grâce à un appel axios (librairie front
permettant de faire des appels AJAX).



