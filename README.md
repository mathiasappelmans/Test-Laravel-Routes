## Test Laravel Routing

After cloning this repository, run 
```
composer install
php artisan migrate
```

This repository is a PHPUNIT Routing Tests project : 

Fill in `routes/web.php` and `routes/api.php` to resolve the asked task.

Example:

```
// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
// Put one code line here below
// Answer:
Route::get('/user/{name}', [UserController::class, 'show']);
```

To test if all the routes work correctly, there are PHPUnit tests in `tests/Feature/RoutesTest.php` file.

Example:

```php
public function test_user_page_existing_user_found()
    {
        $user = User::factory()->create();
        $response = $this->get('/user/' . $user->name);

        $response->assertOk();
        $response->assertViewIs('users.show');
    }
```
To Run a single Test : `php artisan test --filter test_user_page_existing_user_found` or `vendor/bin/phpunit --filter test_user_page_existing_user_found`

To Run all Tests at once : `php artisan test` or `vendor/bin/phpunit`


---


### Laravel testing documentation

source : https://laravel.com/docs/12.x/testing

### How to use this repository
You do not need to (but you can) serve the app to run the tests, but you need a database to run this tests.
For this tests you can use MySQL or SQLite.
But if you use your existing populated database, be aware that the tests will empty your database and run all migrations again before running each test, because of using `use RefreshDatabase` in the test class.
So it is better to use a separate SQLite database for testing.
Therefore, you need to create an .env.testing, a separate connection in `config/database.php` and connect it in `phpunit.xml`.

The .env.testing will be used automatically when you run `php artisan test` or `vendor/bin/phpunit`.
The .env or .env.local will be used when you serve the app with `php artisan serve`.

### Use MySQL to serve the app
1. Copy and rename `.env.example` to `.env` or `.env.local` (the one you do not commit to git)
2. configure `APP_ENV=local`
3. Generate an APP_KEY in it : `php artisan key:generate --env=local`
4. Create a new DB db_name in your database manager (phpmyadmin, wamp, etc...)
5. Configure your MySQL connection with this DB name in this .env file 
6. Run the migrations `php artisan migrate`.
7. Serve the app on localhost:8000 `php artisan serve`

### Use SQLite to serve the app
1. Copy and rename `.env.example` to `.env` or `.env.local` (the one you do not commit to git)
2. configure `APP_ENV=local`
3. Generate an APP_KEY in .env : `php artisan key:generate --env=local`
4. Configure your SQLite connection in this .env file `DB_CONNECTION=sqlite`
5. Create an empty database file `database/database.sqlite`
6. Check that in `config/database.php` the sqlite connection is like this (default Laravel config)
```'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],
``` 
7. Run the migrations `php artisan migrate`.
8. Serve the app on localhost:8000 `php artisan serve`
9. Finally, run `php artisan optimize:clear` to clear the cache(s) if needed.

### Use a testing env with SQLite to run the tests (in memory or on disk)
1. Copy and rename `.env.example` to `.env.testing`
2. configure APP_ENV=Testing in it
3. remove all DB_ entries from it
4. Generate app key : `php artisan key:generate --env=testing`
5. Add a connection in `config/database.php`
```
'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],
```
And connect it in `phpunit.xml`
```
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

To Run a single Test : `php artisan test --filter test_task_with_no_user` or `vendor/bin/phpunit --filter test_task_with_no_user`

To Run all Tests at once : `php artisan test` or `vendor/bin/phpunit`

Remind, BE CAREFULL !! the `use RefreshDatabase` instruction in `tests/Feature/RelationshipsTest.php` will empty the DB and run all migrations again before running each test.

Finally, run `php artisan optimize:clear` to clear the caches if needed.

### You may encounter MySQL error key too long

Solution 1:

In file appServiceProvider.php in function boot() ->   Schema::defaultStringLength(191);

Solution 2:

Inside config/database.php, replace this line for mysql

```'engine' => null'```

with

```engine' => 'InnoDB ROW_FORMAT=DYNAMIC'```

Then retry    php artisan migrate:fresh