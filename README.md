## Created for SBS

#### Building container
docker-compose build

#### Running containers
docker-compose up

#### Entering container
docker-compose exec app bash

#### Install dependencies (inside container)
composer install

#### Install front-end dependencies (inside container)
npm install

#### Run front-end watcher
npm run watch

#### Compile front-end code
npm run dev

#### Configure project
##### Add row into /etc/hosts file:
127.0.0.1           sbs.loc

##### After configure hosts file u may use following Project URI
http://sbs.loc/

#### Project URI (default)
http://localhost/

##### Depends on Project URI update your .env file

#### Run initialize DB
sh ./dev/initial-db.sh

###
###### Disclaimer
Copyright 2021 © All rights reserved by Luxurno Marcin Szostak.
