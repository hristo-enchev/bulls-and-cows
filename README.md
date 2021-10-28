## About project

- Bulls&cows game with laravel and livewire

## Features

- Laravel 8
- Livewire 2
- Tailwind

## Requirements
- PHP 7.4+
- Composer
- Optional (Node.js, npm)

## Installation

- Clone the project
- Copy `.env.example` and rename it to `.env` then set your database connection details and image path
- `composer install`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan serve`

## Simple unit test to validate secret number
- ./vendor/bin/phpunit tests/Unit/SecretNumberTest.php

## Optional
- `npm install`
- `npm run dev`
