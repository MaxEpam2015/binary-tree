# Binary tree

-Starting a Symfony Project:
```
make init
docker-compose run --rm manager-php-cli composer install
```

-Other commands for help:
```
docker-compose run --rm manager-php-cli composer create-project symfony/website-skeleton skeleton
docker-compose run --rm manager-php-cli php bin/console about

docker-compose run --rm manager-php-cli php bin/console make:migration
docker-compose run --rm manager-php-cli php bin/console doctrine:migrations:migrate
docker-compose run --rm manager-php-cli php bin/console doctrine:migrations:diff //change data
docker-compose run --rm manager-php-cli php bin/console doctrine:database:create
docker-compose run --rm manager-php-cli php bin/console make:entity

docker exec -ti binarytree_manager-php-fpm_1 bash
su postgres
```
