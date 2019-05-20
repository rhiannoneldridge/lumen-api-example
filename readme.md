## Users and Roles API Example using Lumen and Swagger

1. Clone Git Repo
2. Copy `.env.example` to `.env` and edit as appropriate
3. `php composer install`
4. `php artisan migrate`
5. `php artisan db:seed`
6. `php artisan swagger-lume:generate`
7. `php -S localhost:8000 -t public`
8. Then go to `http://localhost:8000`
9. Click `Authorize`
10. Type in the API Key `test`
11. Try out the API methods