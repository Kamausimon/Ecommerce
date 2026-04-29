# 🛒 Laravel Ecommerce Application

A full-stack ecommerce platform built with **Laravel**, **MySQL**, **Tailwind CSS**, and **MPESA payment integration**.

The application allows customers to browse products, add items to cart, place orders, and make payments. Administrators can manage products, categories, subcategories, users, and orders through a dedicated admin dashboard.

---

## 📌 Project Overview

This project is designed to provide a simple but complete ecommerce experience. It includes the core features needed in an online store, such as product management, cart functionality, customer orders, user authentication, admin controls, and payment integration.

It can be used as:

- A portfolio project
- A learning project for Laravel ecommerce development
- A starting point for a more advanced online store

---

## 🚀 Features

### 🛍️ Product Management

- Add, edit, and delete products
- Manage product categories and subcategories
- Upload and display product images
- Display product price, description, and stock status
- Organize products for easier browsing

### 🛒 Cart and Orders

- Add products to cart
- Update product quantities
- Remove items from cart
- Place customer orders
- View customer order history
- Manage orders from the admin dashboard

### 💳 Payment Integration

- MPESA payment integration
- Secure payment configuration using environment variables
- Support for payment-related order processing

### 👤 User Management

- User registration and login
- Role-based access control
- Customer profiles
- Customer order history

### 🧑‍💼 Admin Dashboard

- Manage products
- Manage categories and subcategories
- Manage customer orders
- Manage users
- View ecommerce activity from one central dashboard

### 📱 Responsive Design

- Mobile-friendly interface
- Built with Tailwind CSS
- Works across desktop, tablet, and mobile screens

---

## 🧰 Tech Stack

| Area | Technology |
|---|---|
| Backend | Laravel |
| Frontend | Blade, Tailwind CSS |
| Database | MySQL |
| Authentication | Laravel Authentication |
| Payments | MPESA |
| Package Management | Composer, NPM |
| Server | Apache / Laravel Development Server |

---

## ✅ Requirements

Before running the project, make sure you have the following installed:

| Requirement | Version |
|---|---|
| PHP | 8.0 or later |
| Laravel | 9.x |
| Composer | Latest stable version |
| MySQL | 5.7 or later |
| Node.js | Latest LTS recommended |
| NPM | Latest stable version |
| Apache | Recommended for local hosting |

---

## ⚙️ Installation

### 1. Clone the repository

``bash
git clone https://github.com/kamausimon/Ecommerce.git
cd Ecommerce

### 2. Install PHP dependencies
composer install

 ### 3. Install JavaScript dependencies
npm install

### 4. Compile frontend assets
npm run dev

### 5. Create the environment file
cp .env.example .env

### 6. Generate the application key
php artisan key:generate
🗄️ Database Setup

Create a MySQL database for the project, then update your .env file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

Run migrations and seeders:

php artisan migrate --seed
▶️ Running the Application

Start the Laravel development server:

php artisan serve

The application should now be available at:

http://localhost:8000
🔐 Environment Configuration
MPESA Configuration

Add your MPESA credentials to the .env file:

MPESA_CONSUMER_KEY=your_mpesa_consumer_key
MPESA_CONSUMER_SECRET=your_mpesa_consumer_secret

Depending on your MPESA implementation, you may also need:

MPESA_SHORTCODE=your_shortcode
MPESA_PASSKEY=your_passkey
MPESA_CALLBACK_URL=your_callback_url
MPESA_ENV=sandbox
📧 Email Configuration

Configure your email provider in .env:

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="${APP_NAME}"
👥 User Roles
Role	Permissions
Admin	Manage products, orders, categories, subcategories, and users
Customer	Browse products, add to cart, place orders, make payments, and view order history
🧑‍💼 Admin Access

⚠️ Change default admin credentials before using the application in production.

🧪 Common Commands

Clear application cache:

php artisan cache:clear

Clear configuration cache:

php artisan config:clear

Run migrations:

php artisan migrate

Run migrations with seeders:

php artisan migrate --seed

Run queue worker:

php artisan queue:work

Compile assets for development:

npm run dev

### Compile assets for production:

 npm run build
🔒 Security Notes
Do not commit your .env file to GitHub.
Store API keys and payment credentials inside environment variables.
Change default admin credentials before deployment.
Validate and authorize user actions on protected routes.
Use HTTPS in production, especially for authentication and payments.
Avoid exposing sensitive user information in API responses.
📁 Suggested Project Structure
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
database/
├── migrations/
├── seeders/
resources/
├── views/
routes/
├── web.php
├── api.php
public/
🤝 Contributing

Contributions are welcome.

### To contribute:

Fork the repository.
Create a new branch:
git checkout -b feature/new-feature
Make your changes.
Commit your changes:
git commit -m "Add new feature"
Push to your branch:
git push origin feature/new-feature
Open a pull request.

Please make sure your code follows Laravel best practices and includes relevant tests where possible.




Platform	Link
Email	kamausimon217@gmail.com

Twitter	@kamau_codes


### This project is part of my backend/full-stack development portfolio and demonstrates experience with:

Laravel application development
Ecommerce workflows
Database-backed web applications
Authentication and authorization
MPESA payment integration
Admin dashboard implementation
Responsive UI design
