# Lumen Blog
* [Demo Link](https://lumen-blog.herokuapp.com)
* [Postman Collection](https://www.postman.com/collections/b03d3372aa7e457564b3)

## Used in this project:
* Laravel Lumen 8
* Passport OAuth

## Available Scripts To Run In Order
* Firstly, create a mysql database and create .env file from .env.example

```bash 
$ composer install
```
```bash 
$ php artisan key:generate
```
```bash 
$ php artisan migrate --seed
```
```bash 
$ php artisan passport:install
```
```bash 
$ php artisan serve
```

## Note:
* Password for all fake users is <b>demo123</b>
