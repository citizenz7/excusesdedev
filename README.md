# excusesdedev.infos.st
Site humoristique - Créé avec Symfony

## Environnement de développement
### Pré-requis
* PHP 7.4
* Composer
* Symfony CLI
* MySQL

Vous pouvez vérifier les pré-requis (sauf Docker et Docker-compose) avec la commande suivante (issue de la CLI Symfony) :
```bash
symfony check:requirements
```

### Lancer l'environnement de développement
```bash
composer install
docker-compose up -d
symfony serve -d
```

### Création du compte admin
```bash
symfony console app:create-user EMAIL PASSWORD
```

Ce qui donnera par exemple :
```bash
symfony console app:create-user john.doe@gmail.com password
```