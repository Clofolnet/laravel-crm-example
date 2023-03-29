# Laravel - Test CRM for universities

A small CRM-system for universities is made for the real business task. There are data factories, testing

# Running a project with Docker:
1. `git clone <project_url>`
2. `cd <project_name>`
3. `Rename the .env.docker file to .env` 
4. `docker compose build app`
5. `docker compose up -d`
6. `docker compose exec app composer install`
7. `docker compose exec app php artisan migrate`
8. Complete)

# Running tests with Docker:
1. `git clone <project_url>`
2. `cd <project_name>`
3. `Rename the .env.docker file to .env` 
4. `docker compose build app`
5. `docker compose up -d`
6. `docker compose exec app composer install`
7. `docker compose exec app php artisan migrate`
8. `docker compose exec app php artisan test`
9. Complete)
