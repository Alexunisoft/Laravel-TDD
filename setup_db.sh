#!/bin/bash

docker run -d --rm --name mysql -v tdd_laravel:/var/lib/mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=bookstore mysql:8.0.22
