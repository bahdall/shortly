up: docker-up
restart: docker-down docker-up
composer-install: docker-composer-install
composer-update: docker-composer-update
artisan-migrate: docker-artisan-migrate

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-composer-install:
	docker-compose exec app composer install

docker-composer-update:
	docker-compose exec app composer update

docker-artisan-migrate:
	docker-compose exec app php artisan migrate
