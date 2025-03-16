start:
	docker-compose up -d --build

stop:
	docker-compose down -v

install:
	docker-compose exec app composer install

migrate:
	docker-compose exec app php artisan migrate

migrate-test:
	docker-compose exec app php artisan migrate --env=testing

seed:
	docker-compose exec app php artisan db:seed

test:
	docker-compose exec app php artisan test

bash:
	docker exec -it laravelchallenge_app bash
