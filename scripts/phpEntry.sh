#!/bin/sh
php artisan cache:clear
#composer install
php artisan cache:clear
php artisan optimize
#php artisan serve --host 0.0.0.0
exec $@

