Laravel Ecommerce Application
Portfolio README Document
A full-stack ecommerce web application built with Laravel, MySQL, Tailwind CSS, and MPESA payment integration. The platform allows customers to browse products, manage carts, place orders, and make payments, while administrators can manage products, categories, orders, and users through an admin dashboard.
Overview
This Laravel Ecommerce Application is designed to provide a simple and reliable online shopping experience for customers and an easy-to-manage backend for administrators.
The project includes core ecommerce features such as product management, categories, subcategories, shopping cart functionality, order management, user authentication, and MPESA payment integration.
It can be used as a learning project, portfolio project, or a starting point for building a more advanced ecommerce platform.
Features
Product Management
•	Add, edit, and delete products.
•	Manage product categories and subcategories.
•	Display product details, pricing, images, and stock information.
•	Organize products for easier browsing and discovery.
Cart and Order Management
•	Add products to cart.
•	Update cart quantities.
•	Place customer orders.
•	View and manage order history.
•	Track order status from the admin dashboard.
Payment Integration
•	MPESA integration for customer payments.
•	Secure handling of payment-related configuration through environment variables.
User Management
•	User registration and login.
•	Role-based access for administrators and customers.
•	Customer profile and order history management.
Admin Dashboard
•	Manage products, categories, subcategories, orders, and users.
•	View customer orders.
•	Update order information.
•	Control ecommerce data from a centralized dashboard.
Responsive Design
•	Mobile-friendly interface built with Tailwind CSS.
•	Responsive layout for desktop, tablet, and mobile users.
Tech Stack
•	Backend: Laravel
•	Frontend: Blade, Tailwind CSS
•	Database: MySQL
•	Authentication: Laravel authentication system
•	Payments: MPESA
•	Package Manager: Composer, NPM
•	Server: Apache / Laravel development server
Requirements
•	PHP 8.0 or later
•	Laravel 9.x
•	Composer
•	MySQL 5.7 or later
•	Node.js and NPM
•	Apache server or another local development server
Installation
Clone the repository:
git clone https://github.com/kamausimon/Ecommerce.git
cd Ecommerce
Install PHP dependencies:
composer install
Install JavaScript dependencies:
npm install
Compile frontend assets:
npm run dev
Create your environment file:
cp .env.example .env
Generate the application key:
php artisan key:generate
Create a MySQL database, then update your .env file with your database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
Run database migrations and seeders:
php artisan migrate --seed
Start the development server:
php artisan serve
The application should now be available at:
http://localhost:8000
Environment Configuration
MPESA Configuration
Add your MPESA credentials to the .env file:
MPESA_CONSUMER_KEY=your_mpesa_consumer_key
MPESA_CONSUMER_SECRET=your_mpesa_consumer_secret
You may also need additional MPESA configuration values depending on your implementation, such as shortcode, passkey, callback URL, and environment mode.
MPESA_SHORTCODE=your_shortcode
MPESA_PASSKEY=your_passkey
MPESA_CALLBACK_URL=your_callback_url
MPESA_ENV=sandbox
Email Configuration
Configure your mail provider in the .env file:
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="${APP_NAME}"
Additional Configuration
You can also configure caching, logging, queues, and other Laravel services based on your deployment environment.
Usage
Customer
•	Register and log in.
•	Browse available products.
•	Add products to cart.
•	Place orders.
•	Make payments through MPESA.
•	View their order history.
Admin
•	Manage products.
•	Manage categories and subcategories.
•	View and manage customer orders.
•	Manage users.
•	Access the admin dashboard.
Admin dashboard URL:
/admin
Default admin credentials can be configured in the database seeder. Example:
Email: admin@example.com
Password: password
For security, change the default credentials before using the application in production.
User Roles
Admin
Has access to the admin dashboard and can manage products, orders, categories, subcategories, and users.
Customer
Can browse products, place orders, make payments, and manage their account.
Common Commands
Clear application cache:
php artisan cache:clear
Clear configuration cache:
php artisan config:clear
Run migrations:
php artisan migrate
Run migrations with seeders:
php artisan migrate --seed
Run the queue worker:
php artisan queue:work
Compile assets for development:
npm run dev
Compile assets for production:
npm run build
Security Notes
•	Do not commit your .env file to GitHub.
•	Store API keys and payment credentials in environment variables.
•	Change default admin credentials before deployment.
•	Validate and authorize user actions on protected routes.
•	Use HTTPS in production, especially for authentication and payments.
Contributing
Contributions are welcome. To contribute:
1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Commit your changes.
5. Push to your branch.
6. Open a pull request.
git checkout -b feature/new-feature
git commit -m "Add new feature"
git push origin feature/new-feature
Please ensure your code follows Laravel best practices and includes relevant tests where possible.
License
This project is licensed under the MIT License. See the LICENSE file for more information.
Contact
Kamau Simon
•	Email: kamausimon217@gmail.com
•	Twitter: @kamau_codes
•	GitHub: kamausimon
