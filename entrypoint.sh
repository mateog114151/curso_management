#!/bin/bash

# Espera opcional por la base de datos (Railway suele estar lista rápido)
sleep 3

# Ejecuta comandos Artisan en runtime
php artisan key:generate --force
php artisan storage:link
php artisan migrate --force

# Levanta el servidor Laravel
php artisan serve --host=0.0.0.0 --port=8000
