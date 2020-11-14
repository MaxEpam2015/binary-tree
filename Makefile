init: docker-down-clear manager-clear docker-pull docker-build docker-up manager-init

docker-down:
	docker-compose up -d

manager-clear:
	docker run --rm -v ${PWD}/manager:/app --workdir=/app alpine rm -f .ready

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

docker-up:
	docker-compose up -d

manager-init: manager-composer-install manager-assets-install manager-oauth-keys manager-wait-db manager-migrations manager-fixtures manager-ready

docker-down-clear:
	docker-compose down -v --remove-orphans

dev-build:
	docker build --file=manager/docker/development/php-cli.docker --tag manager-php-cli manager/docker/development

dev-cli:
	docker run --rm -v ${PWD}/manager:/app manager-php-cli php bin/app.php

cli:
	docker-compose run --rm manager-php-cli php bin/app.php

run:
	docker-compose run --rm manager-php-cli composer create-project symfony/website-skeleton skeleton

