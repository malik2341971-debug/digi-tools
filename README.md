# 🛠️ Digi-Tools - Laravel Role-Based Auth Starter

[![Laravel Version](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](https://opensource.org/licenses/MIT)

A clean, modern, and production-ready Laravel 11 starter application equipped with a lightweight, built-in **Role-Based Access Control (RBAC)** authentication system.

---

## ✨ Features

- **Standard Authentication**: Out-of-the-box user registration, login, profile management, and password resets powered by **Laravel Breeze (Blade + Tailwind CSS)**.
- **Lightweight Built-In RBAC**: Uses an Enum-based `'role'` column (`admin` & `user`) on the `users` table. Zero heavy external dependencies, making it clean, fast, and easy to maintain.
- **Custom Middleware Protection**: Includes a `RoleMiddleware` to secure routes based on allowed roles.
- **Differentiated Dashboards**:
  - **Admin Dashboard (`/admin/dashboard`)**: Dedicated panel styled for Administrators, protected by the `role:admin` middleware.
  - **User Dashboard (`/dashboard`)**: Standard panel displaying user details and access level.
- **MySQL Ready**: Pre-configured database connections for MySQL/MariaDB (perfect for XAMPP environments).
- **Fully Tested**: Features integration tests validating access blocks for guests, regular users, and admin access.

---

## 🔑 Seeded Demo Credentials

Run the database seeder to immediately log in with the following accounts:

| Email | Password | Role | Access Level |
| :--- | :--- | :--- | :--- |
| **`admin@example.com`** | `password` | `admin` | Full Access (Dashboards & Admin Panels) |
| **`user@example.com`** | `password` | `user` | Standard Access (Blocked from Admin Panel) |

---

## 🚀 Quick Start / Installation

Follow these steps to set up the project locally:

### 1. Clone & Install PHP/Node Dependencies
```bash
git clone https://github.com/malik2341971-debug/digi-tools.git
cd digi-tools
composer install
npm install
```

### 2. Configure Environment variables
Duplicate the example environment file:
```bash
copy .env.example .env
```

### 3. Generate Encryption Key
```bash
php artisan key:generate
```

### 4. Configure the Database
1. Open your MySQL server (e.g., through XAMPP Control Panel).
2. Create a new database named `digi_tool`.
3. Open your `.env` file and make sure the connection parameters match your setup:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=digi_tool
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### 5. Run Migrations & Seeders
Migrate database tables (which include the new `role` column) and populate the demo accounts:
```bash
php artisan migrate:fresh --seed
```

### 6. Compile Assets & Start the Server
Compile CSS/JS assets using Vite and spin up the PHP development server:
```bash
npm run build
php artisan serve
```
Open **`http://127.0.0.1:8000`** in your browser to view the application!

---

## 🛠️ Codebase Highlights

Below are the key files and folders that implement the RBAC system:

* **Roles Enum** ([`app/Enums/UserRole.php`](app/Enums/UserRole.php)):
  Stores valid user roles: `admin` and `user`.
* **Database Migration** ([`database/migrations/0001_01_01_000000_create_users_table.php`](database/migrations/0001_01_01_000000_create_users_table.php)):
  Adds `$table->string('role')->default('user');` to the schema.
* **User Model** ([`app/Models/User.php`](app/Models/User.php)):
  Casts the `'role'` attribute to the `UserRole` enum and contains the `isAdmin()` helper function.
* **Role Middleware** ([`app/Http/Middleware/RoleMiddleware.php`](app/Http/Middleware/RoleMiddleware.php)):
  Validates if the user's role is allowed to access routes:
  ```php
  public function handle(Request $request, Closure $next, string ...$roles): Response
  {
      if (! $request->user() || ! in_array($request->user()->role->value, $roles)) {
          abort(403, 'Unauthorized action.');
      }
      return $next($request);
  }
  ```
* **Middleware Mapping** ([`bootstrap/app.php`](bootstrap/app.php)):
  Registers the `'role'` middleware alias.
* **Route Protection** ([`routes/web.php`](routes/web.php)):
  Restricts the Admin Dashboard route:
  ```php
  Route::get('/admin/dashboard', function () {
      return view('admin.dashboard');
  })->middleware(['auth', 'role:admin'])->name('admin.dashboard');
  ```
* **Integration Tests** ([`tests/Feature/RoleBasedAuthTest.php`](tests/Feature/RoleBasedAuthTest.php)):
  Ensures guests are redirected, users are forbidden, and admins successfully enter the panel.

---

## 🧪 Running Tests

To run the full unit and feature test suites (including our RBAC validation tests):
```bash
php artisan test
```

---

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
