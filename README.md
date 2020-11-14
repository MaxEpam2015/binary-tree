# Binary tree
>php bin/console about
>
>php bin/console make:entity
>
>php bin/console make:migration
>
>docker-compose run --rm manager-php-cli php bin/console doctrine:migrations:migrate
>
>docker-compose run --rm manager-php-cli php bin/console doctrine:migrations:diff //change data
>
>php bin/console doctrine:database:create

>docker exec -ti binarytree_manager-php-fpm_1 bash
>
>docker-compose run --rm manager-php-cli composer create-project symfony/website-skeleton skeleton
>
>docker-compose run --rm manager-php-cli php bin/console make:entity
>
>su postgres
