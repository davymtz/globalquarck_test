# Pasos para levantar entorno Docker
Estos pason para tener habilitado un entorno de servicios condocker, tales como:
- MySQL
- PHP-FPM
- Nginx

## Installation
Necesitas tener instalado [docker](https://www.docker.com/) y [docker compose](https://docs.docker.com/compose/).

Si se cumple con estos requisitos, en la terminal ejecutamos este comando:
```bash
docker compose up -d --build
```

Para poder ver si los  servicios estan corriendo procederemos a ejecutar en la terminal este comando:
```bash
docker ps -a
```
Y verificar que efectivamente en la columna status, estén en up.

Una vez hayamos hecho lo anterior, procederemos a ejecutar este comando en la misma terminal.
```bash
docker exec fpm_service bash -c "cd globalquarck && cp .env.example .env && composer install"
```
Esto se hace con la intención de instalar los paquetes necesarios para poder correr el programa.

Después correremos las migraciones necesarias para tener las tablas para nuestro sistema:
```bash
docker exec fpm_service bash -c "cd globalquarck && php artisan key:generate"
docker exec fpm_service bash -c "cd globalquarck && php artisan migrate"
```

Si no ocurre ningún error, entrar con el navegador preferido a [localhost](http://localhost)

Una vez acabado con el proyecto, eliminar los contenedores con el siguiente comando:
```bash
docker compose down
```

## Nota: En dado caso que no quiera hacer todo el proceso con docker, solamente extreaer el proyecto que se encuentra en
## backend/globalquarck y hacer sus propias configuraciones para su entorno y tener instalado composer para los paquetes necesarios.