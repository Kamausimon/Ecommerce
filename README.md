Laravel eCommerce Application




Table of Contents
Introduction
Features
Requirements
Installation
Configuration
Usage
Contributing
License
Contact
Introduction
Welcome to the Laravel eCommerce Application! This project is a fully-featured eCommerce platform built using the powerful Laravel framework. It aims to provide a seamless shopping experience with an easy-to-use interface for both customers and administrators.

Whether you are looking to start your own online store or want to learn more about eCommerce application development, this project serves as an excellent starting point.

Key Objectives:
User-friendly: An intuitive interface for easy navigation and product discovery.
Scalable: Built with scalability in mind to handle growing traffic and data.
Secure: Implements best practices for security and data protection.
Customizable: Easily extendable to fit specific business needs.
Features
Product Management:

Add, update, and delete products.
Categorize products and manage subcategories.
Order Management:

Cart system with order placement.
Order tracking and management.
Payment Integration:

Integration with MPESA for secure payments.
User Management:

Authentication with role-based access.
User profiles and order history.
Responsive Design:

Mobile-friendly layout with tailwind.
Admin Dashboard:

Requirements
Before you begin, ensure you have met the following requirements:

PHP 8.0 or later
Laravel 9.x
Composer
MySQL 5.7 or later
Node.js & NPM
Apache server
Installation
Follow these steps to set up the project locally:

Clone the repository:

bash
Copy code
git clone https://github.com/kamausimon/Ecommerce.git
cd laravel-ecommerce
Install dependencies:

bash
Copy code
composer install
npm install
npm run dev
Copy .env.example to .env:

bash
Copy code
cp .env.example .env
Generate application key:

bash
Copy code
php artisan key:generate
Set up the database:

Create a MySQL database for the application.

Update the .env file with your database credentials.

env
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
Run migrations and seed the database:

bash
Copy code
php artisan migrate --seed
Start the development server:

bash
Copy code
php artisan serve
Your application should now be running at http://localhost:8000.

Configuration
Payment Integration
To integrate MPESA you need to configure the following settings in your .env file:

env
Copy code
# MPESA Configuration
MPESA_CONSUMER_KEY=your_mpesa_consumer_key
MPESA_CONSUMER_SECRET=your_mpesa_consumer_secret


Email Configuration
Set up your email service provider to send notifications:

env
Copy code
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_NAME="${APP_NAME}"
Additional Configurations
Caching: Configure caching for better performance.
Logging: Customize log channels as needed.
Usage
User Roles
The application supports multiple user roles:

Admin: Full access to manage products, orders, and users.
Customer: Can browse products, place orders, and manage their account.
Common Commands
Clear Cache:

bash
Copy code
php artisan cache:clear

bash
Copy code
php artisan queue:work
Accessing the Admin Dashboard
URL: /admin
Default Admin Credentials: (you can set these in the seeder file)
Email: admin@example.com
Password: password
Contributing
We welcome contributions! Here's how you can help:

Fork the repository.
Create a new branch (git checkout -b feature/new-feature).
Make your changes.
Commit your changes (git commit -m 'Add new feature').
Push to the branch (git push origin feature/new-feature).
Open a pull request.
Please ensure your code adheres to our coding standards and includes relevant tests.

License
This project is licensed under the MIT License. See the LICENSE file for details.

Contact
Feel free to reach out if you have any questions or suggestions:

Email: kamausimon217@gmail.com
Twitter: @kamau_codes



