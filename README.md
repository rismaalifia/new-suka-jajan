# SukaJajan - Platform Kuliner Semarang

## Setup

```bash
composer install
cp env .env
```

Edit `.env` — sesuaikan port database (default `3306`, MAMP pakai `8889`):

```ini
database.default.port = 3306
```

## Jalankan

```bash
mysql -u root -e "CREATE DATABASE sukajajan"
php spark migrate
php spark db:seed InitialSeeder
mkdir -p public/uploads/kuliner public/uploads/thumbnails
php spark serve
```

Buka **http://localhost:8080**

## Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@sukajajan.com | admin123 |
| User | user1@sukajajan.com | user123 |

## Reset Database

```bash
php spark migrate:rollback
php spark migrate
php spark db:seed InitialSeeder
```
