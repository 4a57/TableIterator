# Big Table Iterator

### Overview
Iterator to iterate on big MySQL tables

### Requirements
* PHP 7.*
* composer
* MySQL

### Setup
1. Composer install:
    ```
    composer install
    ```
1. Set properly config to db connection in `db.php`
1. Run migration to create DB:
    ```
    php bin/migrate.php
    ```
1. Generate data
    ```
    php bin/generate.php [numberOfRows]
    ```

### Run
Run to lists ids of all results:
```
php bin/iterate.php
```