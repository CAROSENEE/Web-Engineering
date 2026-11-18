# Question 2 — Student Result Portal

Laravel 9 application with authenticated student CRUD, Eloquent one-to-many student/results models, server-side validation, and a result entry page that assigns grades automatically.

## Requirements

- PHP 8.0 or later with `pdo_sqlite`, Composer 2, and a web browser.
- Dependencies are locked in `composer.lock` and installed locally with Composer.

## Run locally (PowerShell)

```powershell
cd "D:\CAROSINE\Web-Engineering\LAB-EXAM\Question-2-Student-Result-Portal"
if (-not (Test-Path .env)) { Copy-Item .env.example .env }
composer install
php artisan key:generate
if (-not (Test-Path database/database.sqlite)) { New-Item -ItemType File database/database.sqlite | Out-Null }
php artisan migrate --seed
php artisan portal:user
php artisan serve
```

Open `http://127.0.0.1:8000`, sign in with the email and password created by `portal:user`, and manage students and results. The project is configured for SQLite; Laravel resolves its default SQLite database path to the absolute `database/database.sqlite` location. Do not commit `.env` or real credentials.

## Grade scale

| Marks | Grade |
|---:|:---|
| 80–100 | A+ |
| 75–79.99 | A |
| 70–74.99 | A− |
| 65–69.99 | B+ |
| 60–64.99 | B |
| 55–59.99 | B− |
| 50–54.99 | C+ |
| 45–49.99 | C |
| 40–44.99 | D |
| 0–39.99 | F |

The scale is implemented in `app/Models/Result.php` and can be adjusted to the institution's policy.
