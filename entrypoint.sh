#!/bin/bash

# Espera a que MySQL esté listo (opcional, si tienes delay)
sleep 5

# Comandos Laravel
php artisan key:generate --force
php artisan storage:link
php artisan migrate --force

# Inicia el servidor
php artisan serve --host=0.0.0.0 --port=8000
