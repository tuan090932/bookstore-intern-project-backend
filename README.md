# API ADMIN LARAVEL
### Environmental information
- PHP: 8.1.21
- MySQL: 8.0.24
- Laravel: v10.48.12 
- Nginx

### Setup
Start docker:

```
docker-compose up -d
```

Install composer

```
docker-compose exec php-fpm composer install
```

Copy .env

```
docker-compose exec php-fpm cp .env.example .env
```

Generate key

```
docker-compose exec php-fpm php artisan key:generate
```

Run migration

```
docker-compose exec php-fpm php artisan migrate
```

Run seeder

```
docker-compose exec php-fpm php artisan db:seed
```

NPM install

```
docker-compose exec php-fpm npm install
```

NPM run dev

```
docker-compose exec php-fpm npm run dev
```

Link:

```
http://localhost
```

Error:
If you encounter this error when running Docker:
Composer detected issues in your platform: Your Composer dependencies require a PHP version ">= 8.1.0".
You can fix it with the following command:

```
composer install --ignore-platform-reqs
```

### Connect database MySQL info
```
HOST: 127.0.0.1
PORT: 3306
USERNAME: root
PASSWORD: root
DATABASE_NAME: bookstore
```

### PINT 
```
docker-compose exec php-fpm ./vendor/bin/pint
```

