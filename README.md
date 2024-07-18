# Jobboard (core)

## Déploiement

```sh
[tic6tm@groupe6tm-marketplace-web ~]$ cd prod
[tic6tm@groupe6tm-marketplace-web ~]$ cd *dossier du vhost du nouveau jobboard* 
[tic6tm@groupe6tm-marketplace-web ~]$ git clone *lien du git*
[tic6tm@groupe6tm-marketplace-web ~]$ php artisan key:generate
[tic6tm@groupe6tm-marketplace-web ~]$ composer install
[tic6tm@groupe6tm-marketplace-web ~]$ composer update
[tic6tm@groupe6tm-marketplace-web ~]$ npm install
[tic6tm@groupe6tm-marketplace-web ~]$ npm update
```
Editer le .env et utiliser les logins du phpmyadmin pour le vhosts

```sh
[tic6tm@groupe6tm-marketplace-web ~]$ php artisan migrate
```

Création des "storage links"

```sh
[tic6tm@groupe6tm-marketplace-web dev-annonces.tema-media.fr]$ php artisan storage:link
```
