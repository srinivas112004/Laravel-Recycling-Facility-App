#  Recycling Facility Directory – Laravel Application

##  Objective
A Laravel-based CRUD web app to manage a Recycling Facility Directory stored in MySQL. Includes search, filter, sort, pagination, Google Maps embed, and CSV export functionality.

---

##  Database Design & Relationships
**Tables**
- `facilities` (`id`, `business_name`, `last_update_date`, `street_address`, timestamps)
- `materials` (`id`, `name`, timestamps)
- `facility_material` (pivot: `facility_id`, `material_id`, unique pair)

**Relationships**
- `Facility` ↔ `Material` is many-to-many via `facility_material`.
- Defined with `belongsToMany` in both models.

---

##  How search, filter, sort, and export are implemented

- **Search** (`q`): matches `business_name`, `street_address`, or related `materials.name` using `orWhereHas`.
- **Filter by Material** (`material_id`): `whereHas('materials')` to include only facilities accepting the selected material.
- **Sort** (`sort=asc|desc`): order by `last_update_date`, then `id` as tiebreaker.
- **Export CSV**: `/facilities/export` rebuilds the same query and streams CSV with columns: Business Name, Last Updated, Address, Materials Accepted.

---

##  Features
- CRUD for facilities with validation.
- Many-to-many materials (select multiple in form).
- Paginated listing (10 per page).
- Search by name/city/material.
- Filter by material.
- Sort by last update date.
- CSV export of **current filters**.
- Detail page with Google Maps embed (no API key required).

---

##  Setup (VS Code)

```bash
# 1) Install dependencies
composer install

# 2) Env & key
cp .env.example .env
php artisan key:generate

# 3) Configure DB in .env, then migrate + seed
php artisan migrate --seed

# 4) Run
php artisan serve
# Open http://127.0.0.1:8000
```

> Note: This repository contains the **application code**. It's expected you run it inside a standard Laravel project (vendor files installed via Composer).

---

##  Bonus (Optional Authentication)
If you want auth:
```bash
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install && npm run dev
# Then protect routes with Route::middleware('auth') in routes/web.php
```

---

## Important Files
- `app/Models/Facility.php`
- `app/Models/Material.php`
- `app/Http/Controllers/FacilityController.php`
- `app/Http/Requests/StoreFacilityRequest.php`
- `app/Http/Requests/UpdateFacilityRequest.php`
- `database/migrations/*`
- `database/seeders/MaterialSeeder.php`
- `database/seeders/FacilitySeeder.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/facilities/*`
- `routes/web.php`
