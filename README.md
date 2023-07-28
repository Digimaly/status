# Digimaly Status

This is the Digimaly Status page's repo. It is purposefully open source, so that anyone can contribute to it, and anyone can use it for their own projects.

## How to use

Digimaly's Status is created using Laravel, Inertia, VueJS, and TailwindCSS. It is a single page application, and is very easy to use.

### Requirements

- PHP 8.1 or higher
- Composer
- NodeJS
- NPM
- A web server (Apache, Nginx, Caddy, etc.)
- A database (MySQL, MariaDB, PostgreSQL, etc.)
- Redis

We're using a 2GB/1CPU VPS from DigitalOcean, and it works great. We're using Ubuntu 20.04, but you can use any OS you want.

### Installation

1. Clone the repo
2. Run `composer install`
3. Run `npm install`
4. Copy `.env.example` to `.env`
5. Run `php artisan key:generate`
6. Fill in the `.env` file with your database and Redis credentials
7. Run `php artisan migrate`
8. If you want to add a Logo, put the link in the `APP_LOGO` variable in the `.env` file
9. By default, the LOGO will link to the Digimaly website. If you want to change that, put the link in the `APP_HOME` variable in the `.env` file
10. Run `php artisan make:user` to generate a user.
11. Setup Laravel Horizon for the queue, we suggest using supervisor to run the queue in the background.

The rest is up to you. You can add components, change the colors, and more. If you want to change the logo, you can do so by changing the `APP_LOGO` variable in the `.env` file.
