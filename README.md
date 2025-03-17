# Challenge Laravel

Este es un proyecto de Laravel que se ha creado un challenge.
La aplicación cuenta de dos partes:

1. Un comando de consola que carga los datos de las entidades.
2. Una API REST que contiene información de entidades.

El comando de consola se encarga de cargar los datos de las entidades y de mantener la API REST actualizada.

## Requerimientos

- PHP 8.1+
- Laravel 10.x
- Docker
- Docker Compose
- Make (optional)

## Instalación

Para instalar el proyecto, primero debes clonar el repositorio:

```bash
git clone https://github.com/hernanaguilera/laravel-challenge.git
```

Luego debes levantar los servicios de Docker:

```bash
make start
# o
docker-compose up -d --build
```

Luego debes instalar las dependencias:
```bash
make install
# o
docker-compose exec app composer install
```

Después debes correr las migraciones y los seeds:

```bash
make migrate-fresh
# o
docker-compose exec app php artisan migrate:fresh --seed
```

## Correr el comando de consola

Para correr el comando de console asegurate de tener levantado los servicios de Docker, si no los has iniciado puedes hacerlo con el siguiente comando:

```bash
make start
# o
docker-compose up -d --build
```

Luego debes correr el comando de consola de la siguiente forma:

```bash
make load-entities
# o
docker-compose exec app php artisan load:entities
```

Si todo ha ido bien, deberías ver un mensaje de éxito como el siguiente:

```bash
Datos de la categoría Animals cargados exitosamente.
Datos de la categoría Security cargados exitosamente.
```

Este comando cargará los datos de las entidades y actualizará la API REST.

## Consultar la API REST

Puedes consultar la API REST en el siguiente enlace:

```bash
curl -v http://localhost:8888/api/animals
# o
curl -v http://localhost:8888/api/security
```

Este comando devolverá una respuesta JSON con los datos de las entidades, por ejemplo:

```json
{
    "success": true,
    "data": [
        {
            "api": "AdoptAPet",
            "description": "Resource to help get pets adopted",
            "link": "https://www.adoptapet.com/public/apis/pet_list.html",
            "category": {
                "id": 1,
                "category": "Animals"
            }
        },
        {
            "api": "Axolotl",
            "description": "Collection of axolotl pictures and facts",
            "link": "https://theaxolotlapi.netlify.app/",
            "category": {
                "id": 1,
                "category": "Animals"
            }
        }
    ]
}
```

## Correr tests

Puedes correr los test con el siguiente comando:

```bash
make test
# o
docker-compose exec app vendor/bin/phpunit
```

Debería obtener un resultado similar al siguiente:

```
PHPUnit 10.5.45 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.28
Configuration: /var/www/html/phpunit.xml

........                                                            8 / 8 (100%)

Time: 00:01.398, Memory: 36.50 MB

OK (8 tests, 18 assertions)
```