
# STEADfast URL Shortener

A URL Shortener built using Laravel. This project allows users to shorten long URLs and track the click counts.

## Requirements

Before you begin, ensure you have the following tools installed on your machine:

- **PHP** (>= 8.2)
- **Composer** (for managing PHP dependencies)
- **Node.js and npm** (for managing front-end dependencies)
- **Git** (for cloning the repository)
- **Laravel Framework** (v11.9 or higher)

## Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/moniruzzaman17/url-shortener.git
```

Navigate into the project directory:

```bash
cd url-shortener
```

### 2. Install PHP Dependencies

Make sure you have Composer installed. If not, download it from [here](https://getcomposer.org/download/).

Run the following command to install the PHP dependencies:

```bash
composer install
```

### 3. Install Node.js Dependencies (Optional)

Make sure you have [Node.js](https://nodejs.org/en/download/) and npm installed. Run the following command to install Node dependencies:

```bash
npm install
```

If you need to compile assets, run:

```bash
npm run dev
```

For production-ready assets, use:

```bash
npm run prod
```

### 4. Set Up Environment File

1. Copy the example environment file:

```bash
cp .env.example .env
```

2. Open the `.env` file in your favorite text editor and update the following variables:

- **APP_URL**: This should match your local environment URL (e.g., `http://localhost/url-shortener`)
- **ASSET_URL**: This should also match your local environment URL (e.g., `http://localhost/url-shortener`)

```env
APP_URL=http://localhost/url-shortener
ASSET_URL=http://localhost/url-shortener
```

3. Set up your database configurations (MySQL). For XAMPP/WAMP, the default settings are usually:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create a Database

Create a new MySQL database using phpMyAdmin (or any other tool). Name it as per your `.env` configuration (e.g., `url_shortener`).

```sql
CREATE DATABASE url_shortener_db;
```

### 6. Run Migrations and Seeder

Run the following Artisan command to migrate and seed the database tables:

```bash
php artisan migrate
php artisan db:seed
```

### 7. Generate Application Key

Generate an application key using the Artisan command:

```bash
php artisan key:generate
```

### 8. Serve the Application

Finally, serve the application locally:

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser to view the application.

### 9. Using XAMPP/WAMP

If you're using XAMPP or WAMP, place the project folder inside the `htdocs` folder (for XAMPP) or the respective folder for WAMP.

1. After placing the project inside `htdocs`:
   - Access the project using `http://localhost/url-shortener/public`
2. Make sure your `.env` file's `APP_URL` and `ASSET_URL` match your local path:
   - Example: `http://localhost/url-shortener`

### 10. Clear Caches (If Necessary)

If you run into issues, try clearing the caches:

```bash
php artisan config:cache
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## Tools Required

- **Composer** (for managing PHP dependencies)
  - [Download Composer](https://getcomposer.org/download/)
- **Node.js and npm** (for managing front-end dependencies)
  - [Download Node.js](https://nodejs.org/en/download/)
- **Git** (for cloning the repository)
  - [Download Git](https://git-scm.com/)
- **PHP** (>= 8.2)
- **Laravel Framework** (v11.9 or higher)
- **XAMPP/WAMP** (for running Apache and MySQL)

## Troubleshooting

- **Database Connection Error**: Check your `.env` file for correct database settings and ensure your database server is running.
- **Permission Errors**: If you encounter permission issues, run:

```bash
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
```

- **Composer Not Found**: Ensure that Composer is installed and added to your system's PATH.
- **Error 500**: Check your logs in `storage/logs/laravel.log` for detailed error messages.

---
