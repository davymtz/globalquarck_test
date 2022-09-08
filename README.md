# Pasos para levantar entorno Docker
Estos pason para tener habilitado un entorno de servicios condocker, tales como:
- MySQL
- PHP-FPM
- Nginx

## Installation
Necesitas tener instalado [docker](https://www.docker.com/) y [docker compose](https://docs.docker.com/compose/).

Si se cumple con estos requisitos, en la terminal ejecutamos este comando:
```bash
docker compose up -d
```

Si no ocurre ningún error, entrar con el navegador preferido a [localhost](http://localhost/quiz)