# Current TODOs

Building material pricing per supplier

Suppliers need to be able to set their own prices and identifying numbers / sku

Admin needs to be able to view / edit Supplier pricing and identifying numbers / sku.

# Gotchas...
Make sure the file SentryGroupSeeder.php contains the following -

        Sentry::getGroupProvider()->create(array(

          'name'        => 'Supplier',

          'permissions' => array(

            'admin' => 0,

            'users' => 1,
            
          )));


# composer install

php artisan migrate:refresh --seed

php artisan db:seed --class=SentinelDatabaseSeeder

Be sure to add the admin to the supplier group in the user_group table._


# Interesting Articles for Later Reading

http://www.tutorials.kode-blog.com/laravel-5-angularjs-tutorial

https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers

# Utilizes Rydurham/Sentinel
# Utilizes Laracasts/Generators
https://github.com/laracasts/Laravel-5-Generators-Extended

# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
