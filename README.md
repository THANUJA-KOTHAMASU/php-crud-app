
# PHP CRUD App

This is a simple PHP-based CRUD application with user authentication, built using XAMPP and Bootstrap.

## 📁 Folder Structure

- `index.php` – Homepage with Bootstrap layout for posts
- `login.php`, `register.php` – Auth pages with validation
- `create.php`, `edit.php`, `delete.php`, `view.php` – CRUD actions
- `dashboard.php` – Admin area after login
- `db.php` – DB connection (excluded from Git)
- `db.example.php` – Sample DB config for sharing
- `.gitignore` – Prevents committing sensitive/system files

## 💾 Setup Instructions

1. Place `crud-app/` in `C:/xampp/htdocs/myphpproject/`.
2. Import `crud_db.sql` into phpMyAdmin.
3. Copy `db.example.php` to `db.php` and fill in your DB credentials.
4. Visit `http://localhost/myphpproject/crud-app/` to run.

## 🛠 Tech Used

- PHP + MySQL
- Bootstrap 5
- JavaScript (for form validation)

## ✅ Credentials

Create a user via `register.php` or insert directly into the DB.
