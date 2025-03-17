start:
	docker-compose up -d --build

stop:
	docker-compose down -v

install:
	docker-compose exec app composer install

migrate:
	docker-compose exec app php artisan migrate

migrate-fresh:
	docker-compose exec app php artisan migrate:fresh --seed

migrate-test:
	docker-compose exec app php artisan migrate:fresh --seed --env=testing

seed:
	docker-compose exec app php artisan db:seed

test:
	docker-compose exec app vendor/bin/phpunit

bash:
	docker-compose exec app bash

load-entities:
	docker-compose exec app php artisan load:entities
