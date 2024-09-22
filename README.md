# Laravel Todo List API

This is a simple Todo List API built using Laravel. It allows you to manage tasks with functionalities like creating, updating, deleting, and filtering tasks.

## Requirements

Before you begin, ensure you have met the following requirements:

- PHP >= 8.0
- Composer
- MySQL or another supported database
- Laravel 8+

## Installation

Follow these steps to set up and run the project:

1. **Clone the repository**:
   ```bash
   git clone https://gitlab.com/aksh-ajudiya/todo-api.git
   cd todo-api

2. Install the dependencies: Run the following command to install all necessary dependencies:
composer install

3. Set up the environment variables:

Copy .env.example to .env:
cp .env.example .env

Open the .env file and update the following database details:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_api
DB_USERNAME=root
DB_PASSWORD=

4. Generate the application key: Run the following command to generate a new application key:

php artisan key:generate

5. Run migrations: To set up the database tables, run the migrations:

php artisan migrate

6. Serve the application: Start the development server with the following command:

php artisan serve

You can now access the API at http://localhost:8000.


XAMPP Installation (Optional for Local Development)

If you're developing on a local machine, you can use XAMPP Version 8.2 to simplify the setup process.

Step 1: Download XAMPP

Visit the XAMPP download page.

Download the installer for XAMPP 8.2 (includes PHP 8.2, Apache, and MySQL).

Step 2: Install XAMPP

Run the downloaded installer and follow the setup instructions.

Select the components you need (e.g., Apache, MySQL, PHP).

Step 3: Start XAMPP

Open XAMPP Control Panel and start Apache and MySQL.

Use phpMyAdmin to manage your database, or connect MySQL through your terminal.

Now your local server is ready to run the Laravel application.


