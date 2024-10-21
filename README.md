# Laravel Project with Midtrans Integration

This project is a Laravel-based web application with Midtrans payment gateway integration and Filament Admin for backend management.

## Installation Instructions

### 1. Clone the Repository

```
git clone https://github.com/your-repository.git
cd your-repository
2. Install Dependencies
```
Run the following command to install the required dependencies:

```
composer install
```
3. Set Up Environment
Copy the .env.example file to create a .env file:

```
cp .env.example .env
```
4. Configure Database
Edit the .env file to match your database settings:

```
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
Then, run the migrations to set up the database schema:

```
php artisan migrate
```
5. Midtrans Payment Gateway Integration
Create an account at Midtrans and get your Server Key and Client Key from the Midtrans Sandbox Dashboard.
Copy these keys into your .env file:
```
MIDTRANS_SERVER_KEY=your-server-key
MIDTRANS_CLIENT_KEY=your-client-key
MIDTRANS_IS_PRODUCTION=false
```
The MIDTRANS_IS_PRODUCTION should be set to false for sandbox testing, and you can switch it to true in production.
6. Install and Set Up Filament Admin Panel
Filament Admin is used for managing backend functionality.

Install Filament by running the following command:
```
composer require filament/filament
```
After installing Filament, you can create an admin panel:

```
php artisan make:filament-user
```
You can now log in to the Filament Admin panel and manage your backend.
7. Add Menus in Filament Admin
Once logged in, you can use the Filament Admin interface to add and manage menus for your application.

Run the Application
To start the application, use:

```
php artisan serve
```
Visit http://localhost:8000 to see your application in action.

Features
Midtrans Payment Integration: Allows users to process payments through Midtrans.
Filament Admin: A user-friendly interface for managing the backend.
Responsive Design: Optimized for various devices.
Troubleshooting
If you encounter any issues, ensure the following:

Your database is properly configured.
Your Midtrans credentials are correct.
You have migrated the database before running the application.
go

