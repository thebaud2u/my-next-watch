# MyNextWatch

## Déploiement

```sh
git clone *lien du git*
php artisan key:generate
composer install
composer update
npm install
npm update
```
Editer le .env et utiliser les logins du phpmyadmin pour le vhosts

```sh
php artisan migrate
```

Création des "storage links"

```sh
php artisan storage:link
```
