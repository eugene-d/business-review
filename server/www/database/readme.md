##If you have ERROR "Class 'className' not found", try next:

    $ cd server/www/
    $ php ../composer/composer.phar dump-autoload

## Useful cmd:

Creating Migrations
    $ php artisan make:migration add_votes_to_users_table --table=users
    $ php artisan make:migration create_users_table --create=users

Running All Outstanding Migrations
    $ php artisan migrate --force


Rollback The Last Migration Operation
    $ php artisan migrate:rollback --force

Rollback all migrations
    $ php artisan migrate:reset --force


Rollback all migrations and run them all again
    $ php artisan migrate:refresh --force
    $ php artisan migrate:refresh --seed --force


Database Seeding
    $ php artisan db:seed
    $ php artisan db:seed --class=UserTableSeeder
