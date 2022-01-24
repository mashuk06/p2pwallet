<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About p2p Wallet

This application has been built in basis of following requirements
Scenario: There are two registered users with a single currency based wallet. User
A has a USD and user B has a EUR wallet. User A can send any amount of money
to user B in USD currency. This USD amount will be converted to EUR and
transferred to user B wallet. In the meantime, a confirmation email will be sent to
user B. During the
You will find detailed requirements below. To be successful you don’t have to follow
them strictly. Invest reasonable time depending on your free time and don’t worry if
you can’t finish it all. Focus on the quality of your code, not on the number of
tasks. Make it readable, expandable and production-ready. Make sure you deal
with possible errors etc. Please read the requirements and additional
requirements carefully.
Feel free to ask any questions. Write down any significant problems you
encountered. Let us know how you solved them or how you would tackle them if you
had more time.
Requirements:
-- Use ReactJS / VueJS / Laravel Blade with a secure Laravel / Lumen RESTful
API to develop this currency conversion application.
-- Use any authentication feature to make your API secure e.g. Token, JWT,
Passport or Sanctum.
-- Each user will have only one single currency based wallet.
-- The system should also display the following stats:
-- User who used most conversion.
-- The total amount converted for a particular user.
-- Show the third highest amount of transactions for a particular user
(must use subquery).
-- You have to calculate and store data in the database to show stats properly.
-- We prefer to use a MySQL database for storing user’s data and stats.
-- For interface design using any appropriate responsive design template.
-- In the backend, use an external API to get the currency rates.

## Project Installation

-- composer update
-- php artisan storage:link
-- npm install && npm run dev/watch
-- change env db credentials and mail credentials
-- php artisan migrate:fresh --seed
-- php artisan queue:work/listen
-- Credentials : Email :user1@gmail.com/user2@gmail.com password : 123456

## Api Collection

-- https://www.getpostman.com/collections/382192c400a0d8c243fe


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
