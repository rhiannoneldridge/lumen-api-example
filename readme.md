## Users and Roles API Example using Lumen and Swagger

1. Clone Git Repo
2. Copy `.env.example` to `.env` and edit as appropriate
3. `php composer install`
4. `php artisan migrate:install`
5. `php artisan migrate`
6. `php artisan db:seed`
7. `php artisan swagger-lume:generate`
8. `php -S localhost:8000 -t public`
9. Then go to `http://localhost:8000`