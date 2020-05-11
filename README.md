##Docker environment for a Symfony4 project
==================================

 #Add to your project

Move the `docker-compose.yml` and the folder named `phpdocker` containing nginx and php-fpm config for it to the root of your Symfony4 project.

Ensure the webserver config on `docker\nginx.conf` is correct for your project. For instance, for Symfony4 it should look for the `public/index.php`, instead of the `web/app.php` from Symfony2 and Symfony3

Note: you may place the files elsewhere in your project. Make sure you modify the locations for the php-fpm dockerfile, the php.ini overrides and nginx config on `docker-compose.yml` if you do so.
 
# How to run
* docker-compose exec php-fpm bash
* composer install
* ///php bin/console doctrine:database:create
* mkdir -p config/jwt
* openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096 ОБЯЗАТЕЛЬНО УКАЗЫВАЕМ ПАРОЛЬ ТАКОЙ ЖЕ КАК ЗНАЧЕНИЕ JWT_PASSPHRASE ИЗ ФАЙЛА .env 
* openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
* //// php bin/console doctrine:migrations:diff
* bin/console doctrine:schema:update --force
* php bin/console doctrine:migrations:migrate
* bin/console acl:init
* bin/console fos:user:create --super-admin
* bin/console sonata:admin:setup-acl
* php bin/console cache:clear / (if mistake) rm -rf var/cache/dev/*


# How to send test Push message
* vendor/sly/notification-pusher/np push apns E21CF845D472B5F21DB3E6528F7E666B2D5B58FDF84A7A98623A8D13A7991CD6 "It's an example!" --certificate=/application/config/apns/development.pem

Dependencies:
Once you're done, simply `cd` to your project and run `docker-compose up -d`. This will initialise and start all the containers, then leave them running in the background.


# How to run tests
* php bin/phpunit
* php bin/phpunit tests/unit/Controller
* php bin/phpunit tests/unit/Controller/AllControllerTest.php

# How to make fixtures
* php bin/console make:fix
* php bin/console doctrine:fixtures:load

# Test api
curl -X POST http://localhost/api/login_check
curl -X POST -H "Content-Type: application/json" http://localhost/api/login_check -d '{"username": "admin", "password":"password"}'

#Generate admin password
php -r "echo password_hash('ThePassword', PASSWORD_BCRYPT, ['cost' => 13]) . PHP_EOL;"

# Docker compose cheatsheet

**Note:** you need to cd first to where your docker-compose.yml file lives.

  * Start containers in the background: `docker-compose up -d`
  * Start containers on the foreground: `docker-compose up`. You will see a stream of logs for every container running.
  * Stop containers: `docker-compose stop`
  * Kill containers: `docker-compose kill`
  * View container logs: `docker-compose logs`
  * Execute command inside of container: `docker-compose exec SERVICE_NAME COMMAND` where `COMMAND` is whatever you want to run. Examples:
        * Shell into the PHP container, `docker-compose exec php-fpm bash`
        * Run symfony console, `docker-compose exec php-fpm bin/console`
        * Open a mysql shell, `docker-compose exec mysql mysql -uroot -pCHOSEN_ROOT_PASSWORD`

# Docker general cheatsheet

**Note:** these are global commands and you can run them from anywhere.

  * To clear containers: `docker rm -f $(docker ps -a -q)`
  * To clear images: `docker rmi -f $(docker images -a -q)`
  * To clear volumes: `docker volume rm $(docker volume ls -q)`
  * To clear networks: `docker network rm $(docker network ls | tail -n+2 | awk '{if($2 !~ /bridge|none|host/){ print $1 }}')`

Disclaimer: This project has been generated on phpdocker.io

#Rabbit in kubernetes 
    https://rabbit-rc-1582.c3.syndev.ru
    pass in SymfonyJwtAndAuth/.helm/values.yaml
    
    #https://ok.ru/dk?st.cmd=anonymRegistrationEnterPhone - одноклассники 1 минута КД
    
