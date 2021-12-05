# RetroGamingShop

RetroGamingShop site internet de consoles de jeux videos.

## Environnement de developpement

* PHP 7.4
* Composer
* Symfony CLI
* Docker
* Docker-compose
* nodejs et npm

## creer une base de donnée avec docker

symfony console make:docker:database

## Lancer l'environnement de developpement

composer install
npm install
npm run build
docker-compose up -d
symfony serve -d

## Lancer des tests

symfony console make:unit-test
php bin/phpunit
# avec plus de details
php bin/phpunit --testdox

## Creation d'entité

symfony console make:entity

## faire une migration

symfony console make:migration
symfony console d:m:m ou php bin/console doctrine:migrations:migrate

## installation de webpack-encore

composer require symfony/webpack-encore-bundle
npm install --force
npm install sass-loader@^12.0.0 sass --save-dev
npm install postcss-loader autoprefixer --dev
npm run build

## installation de bootstrap

npm install bootstrap
## pas besoin d'intaller popperJs sur la derniere version de bootstrap
npm install @popperjs/core

## creer un controller

symfony console make:controller

## Production

### Envoie des mails de Contacts

Les mails de prise de contact sont stockés en BDD, pour les envoyer au peintre par mail, il faut mettre en place un cron sur:

symfony console app:send-contact


## preparer et installer le backoffice easyadmin
composer require easycorp/easyadmin-bundle

## creer un dashboard
symfony console make:admin:dashboard


## Securité login

symfony console make:auth

## creation de fausse données

composer require --dev orm-fixtures
composer require fakerphp/faker --dev

## migration des fixtures
symfony console doctrine:fixtures:load

## creer des pages
composer require knplabs/knp-paginator-bundle

## creation d'un formulaire

 symfony console make:form


## Test Webmail
  symfony console app:send-contact

## test coverage permet de generer des rapport
  php bin/phpunit --coverage-html var/log/test/test-coverage

## base de donne environnement test 
APP_ENV=test symfony console doctrine:database:create
APP_ENV=test symfony console doctrine:migrations:migrate -n
APP_ENV=test symfony console doctrine:fixtures:load
symfony console make:functional-test

## Crud:Admin

symfony console make:admin:crud

## installer vich/uploader
composer require vich/uploader-bundle

##  installer liip imagine
composer require liip/imagine-bundle

## https://packagist.org/packages/twig/extra-bundle#:~:text=A%20Symfony%20bundle%20for%20extra%20Twig%20extensions
composer require twig/string-extra
