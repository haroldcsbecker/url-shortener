
- php7.4
- composer
- mariadb / php-msql

# Url Shortener
Project to receive a shorten URL and redirect to full one

### Dependencies

You need to install php 7.4, mysql pdo (php-mysql) and composer

https://computingforgeeks.com/how-to-install-php-on-ubuntu/
https://www.digitalocean.com/community/tutorials/how-to-install-composer-on-ubuntu-20-04-quickstart-pt

### Config

You will need to setup the database to work:

```sh
# use the settings stored in config/settings.php for password and user
sudo mysql_secure_installation
mysql -h localhost -u root -p
```

Create database:
```sql
create database shortener;
```

Run composer and migrations:
```sh
composer update && composer install
vendor/bin/phinx migrate
```

Start local php server
```sh
php -S localhost:8080
```
