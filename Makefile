start:
	docker-compose up -d --build

stop:
	docker-compose down

migrate:
	docker-compose exec laravelchallenge_app php artisan migrate

seed:
	docker-compose exec laravelchallenge_app php artisan db:seed

test:
	docker-compose exec laravelchallenge_app php artisan test

bash:
	docker exec -it laravelchallenge_app bash