#!/bin/bash

php artisan db:drop
php artisan db:create
php artisan migrate:install
php artisan migrate
php artisan db:seed --class=CitySeeder
