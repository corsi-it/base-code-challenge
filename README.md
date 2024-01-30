<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Larvel | Vue (CORS-CHALLENGE)

To download This project simply run this command :
```bash
$ git clone https://github.com/torika2/cors-challenge.git
```
After that you need to install required packages:
```bash
$ cd cors-challenge
$ composer update 
$ npm install
$ npm run dev
```
After that we need to make **.env** file we can simply copy soure from .env.example. and we need to change following variables:
```dotenv
 DB_DATABASE=your_database_name
 DB_USERNAME=database_username
 DB_PASSWORD=users_password
 DB_PORT=users_password
```
Then we need to generate App_key
```bash
$ php artisan key:generate
```
Then we need to migrate migrations and seed our database for required starting data like admin user, posts roles etc.
```bash
$ php artisan migrate --seed
```
Finally you can run server with command:
```bash
$ php artisan serve
```
with default parameters applications url will be [127.0.0.1:8000](http://127.0.0.1:8000)
